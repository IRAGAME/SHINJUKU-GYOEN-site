<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

/**
 * ============================================================
 *  ReservationController : réservation de visite
 * ============================================================
 */

final class ReservationController
{
    /**
     * GET /api/reservations
     * Liste des réservations de l'utilisateur connecté.
     */
    public static function index(): void
    {
        $user = require_auth();

        $stmt = getPDO()->prepare(
            'SELECT id, visit_date, visit_time, visitors, status, created_at
             FROM reservations
             WHERE user_id = ?
             ORDER BY visit_date ASC, visit_time ASC'
        );
        $stmt->execute([$user['id']]);

        json_success(array_map([self::class, 'decorate'], $stmt->fetchAll()));
    }

    /**
     * GET /api/availability?date=YYYY-MM-DD
     * Créneaux horaires disponibles pour une date donnée.
     */
    public static function availability(): void
    {
        $date = $_GET['date'] ?? null;

        if (!$date || !preg_match('/^\d{4}-\d{2}-\d{2}$/', (string)$date)) {
            json_error('invalid_field', 'Le paramètre date est requis (format YYYY-MM-DD).');
        }
        if (strtotime((string)$date) < strtotime(date('Y-m-d'))) {
            json_error('invalid_field', 'La date demandée est dans le passé.', 422);
        }
        if (!self::dateIsOpen((string)$date)) {
            json_error('closed', self::closedReason((string)$date), 422);
        }

        [$opening, $closing] = self::openingHours();
        $capacity  = self::capacityPerSlot();
        $bookedMap = self::bookedCountsBySlot((string)$date);

        $slots = [];
        $slot  = strtotime($opening);
        $end   = strtotime($closing);
        while ($slot < $end) {
            $time   = date('H:i', $slot);
            $booked = $bookedMap[$time] ?? 0;
            $slots[] = [
                'time'       => $time,
                'booked'     => $booked,
                'remaining'  => max(0, $capacity - $booked),
                'full'       => ($booked >= $capacity),
            ];
            $slot = strtotime('+30 minutes', $slot);
        }

        json_success([
            'date'               => $date,
            'opening_hour'       => $opening,
            'closing_hour'       => $closing,
            'capacity_per_slot'  => $capacity,
            'slots'              => $slots,
        ]);
    }

    /**
     * POST /api/reservations
     * Corps : { visit_date, visit_time, visitors }
     */
    public static function store(): void
    {
        $user = require_auth();
        $in   = json_input();
        $pdo  = getPDO();

        $date    = str_field($in, 'visit_date', 10);
        $time    = str_field($in, 'visit_time', 5);
        $visitors = (int)($in['visitors'] ?? 0);

        self::validateBooking($user, $date, $time, $visitors);

        $stmt = $pdo->prepare(
            'INSERT INTO reservations (user_id, visit_date, visit_time, visitors)
             VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$user['id'], $date, $time, $visitors]);

        $stmt = $pdo->prepare(
            'SELECT id, visit_date, visit_time, visitors, status, created_at
             FROM reservations WHERE id = ?'
        );
        $stmt->execute([$pdo->lastInsertId()]);

        json_success(self::decorate($stmt->fetch()), 201);
    }

    /**
     * DELETE /api/reservations/{id}
     * Annule une réservation de l'utilisateur connecté.
     */
    public static function cancel(string $id): void
    {
        $user = require_auth();
        $pdo  = getPDO();

        $stmt = $pdo->prepare('SELECT * FROM reservations WHERE id = ? AND user_id = ?');
        $stmt->execute([(int)$id, $user['id']]);
        $reservation = $stmt->fetch();

        if (!$reservation) {
            json_error('not_found', 'Réservation introuvable.', 404);
        }
        if ($reservation['status'] === 'cancelled') {
            json_error('conflict', 'Cette réservation est déjà annulée.', 409);
        }
        if (strtotime($reservation['visit_date'] . ' ' . $reservation['visit_time']) < time()) {
            json_error('conflict', 'Impossible d\'annuler une visite déjà passée.', 409);
        }

        $pdo->prepare('UPDATE reservations SET status = \'cancelled\' WHERE id = ?')
            ->execute([$reservation['id']]);

        json_success([
            'id'     => (int)$reservation['id'],
            'status' => 'cancelled',
            'message' => 'Votre réservation a été annulée.',
        ]);
    }

    /* ---------------------------------------------------------- */

    /**
     * Valide la demande de réservation (règles métier complètes).
     *
     * @param array<string, mixed> $user
     */
    private static function validateBooking(array $user, string $date, string $time, int $visitors): void
    {
        $pdo = getPDO();

        /* 1. Date bien formée et pas dans le passé */
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) || !self::validDate($date)) {
            json_error('invalid_field', 'La date de visite est invalide (format YYYY-MM-DD).');
        }
        if (strtotime($date) < strtotime(date('Y-m-d'))) {
            json_error('invalid_field', 'La date de visite ne peut pas être dans le passé.');
        }

        /* 2. Jardin ouvert ce jour-là */
        if (!self::dateIsOpen($date)) {
            json_error('closed', self::closedReason($date), 422);
        }

        /* 3. Heure au format HH:MM et dans les horaires d'ouverture */
        if (!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $time)) {
            json_error('invalid_field', "L'heure de visite est invalide (format HH:MM).");
        }
        [$opening, $closing] = self::openingHours();
        if ($time < $opening || $time >= $closing) {
            json_error('invalid_field', "Les visites sont possibles de $opening à $closing.");
        }

        /* 4. Visite le jour même : heure encore dans le futur */
        if ($date === date('Y-m-d') && strtotime($time) <= strtotime(date('H:i'))) {
            json_error('invalid_field', "L'heure choisie est déjà passée pour aujourd'hui.");
        }

        /* 5. Nombre de visiteurs raisonnable */
        $maxVisitors = (int)self::setting('max_visitors_per_reservation', 10);
        if ($visitors < 1 || $visitors > $maxVisitors) {
            json_error('invalid_field', "Le nombre de visiteurs doit être compris entre 1 et $maxVisitors.");
        }

        /* 6. Pas de double réservation au même créneau par le même utilisateur */
        $stmt = $pdo->prepare(
            'SELECT id FROM reservations
             WHERE user_id = ? AND visit_date = ? AND visit_time = ? AND status != \'cancelled\''
        );
        $stmt->execute([$user['id'], $date, $time]);
        if ($stmt->fetch()) {
            json_error('conflict', 'Vous avez déjà une réservation à ce créneau.', 409);
        }

        /* 7. Capacité du créneau non dépassée */
        $capacity = self::capacityPerSlot();
        $stmt = $pdo->prepare(
            'SELECT COALESCE(SUM(visitors), 0) AS total
             FROM reservations
             WHERE visit_date = ? AND visit_time = ? AND status != \'cancelled\''
        );
        $stmt->execute([$date, $time]);
        $already = (int)$stmt->fetch()['total'];

        if ($already + $visitors > $capacity) {
            json_error(
                'slot_full',
                "Le créneau $time est complet (capacité de $capacity visiteurs). Choisissez un autre créneau.",
                422
            );
        }
    }

    /**
     * Comptage des visiteurs déjà réservés, par créneau, pour une date.
     *
     * @return array<string, int>  ["HH:MM" => nbVisiteurs]
     */
    private static function bookedCountsBySlot(string $date): array
    {
        $stmt = getPDO()->prepare(
            'SELECT TIME_FORMAT(visit_time, \'%H:%i\') AS slot, SUM(visitors) AS total
             FROM reservations
             WHERE visit_date = ? AND status != \'cancelled\'
             GROUP BY slot'
        );
        $stmt->execute([$date]);

        $map = [];
        foreach ($stmt->fetchAll() as $row) {
            $map[$row['slot']] = (int)$row['total'];
        }
        return $map;
    }

    /**
     * Jardin ouvert ? (fermé le jour configuré : par défaut lundi)
     */
    private static function dateIsOpen(string $date): bool
    {
        if (!self::validDate($date)) {
            return false;
        }
        $closedWeekday = (int)self::setting('closed_weekday', 1); // 1 = lundi
        return (int)date('N', strtotime($date)) !== $closedWeekday;
    }

    private static function closedReason(string $date): string
    {
        $weekdayNames = ['', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
        $closedWeekday = (int)self::setting('closed_weekday', 1);
        return 'Le jardin est fermé le ' . $weekdayNames[$closedWeekday] . ' (' . date('d/m/Y', strtotime($date)) . ').';
    }

    /**
     * @return array{0:string, 1:string}  [ouverture, fermeture] au format HH:MM
     */
    private static function openingHours(): array
    {
        $opening = self::setting('opening_hour', '09:00');
        $closing = self::setting('closing_hour', '18:00');
        return [$opening, $closing];
    }

    private static function capacityPerSlot(): int
    {
        return (int)self::setting('capacity_per_slot', 100);
    }

    private static function setting(string $key, string|int $default): string
    {
        static $cache = null;
        if ($cache === null) {
            $rows = getPDO()->query('SELECT setting_key, setting_value FROM site_settings')->fetchAll();
            $cache = [];
            foreach ($rows as $row) {
                $cache[$row['setting_key']] = $row['setting_value'];
            }
        }
        return (string)($cache[$key] ?? $default);
    }

    private static function validDate(string $date): bool
    {
        [$y, $m, $d] = array_map('intval', explode('-', $date));
        return checkdate($m, $d, $y);
    }

    /**
     * Ajoute quelques champs "lisibles" à une réservation.
     *
     * @param array<string, mixed> $row
     * @return array<string, mixed>
     */
    private static function decorate(array $row): array
    {
        $row['visit_date_fr']  = date('d/m/Y', strtotime($row['visit_date']));
        $row['visit_time_fr']  = date('H:i', strtotime($row['visit_time']));
        return $row;
    }
}
