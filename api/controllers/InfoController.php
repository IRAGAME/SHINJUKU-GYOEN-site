<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

/**
 * ============================================================
 *  InfoController : informations publiques sur le jardin
 * ============================================================
 */

final class InfoController
{
    /**
     * GET /api/garden
     * Fiche complète du jardin (textes + moyenne des avis).
     */
    public static function garden(): void
    {
        $pdo = getPDO();

        $rows = $pdo->query('SELECT setting_key, setting_value FROM site_settings')->fetchAll();
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }

        $agg = $pdo->query(
            'SELECT COUNT(*) AS total, COALESCE(AVG(rating), 0) AS average FROM comments'
        )->fetch();

        $reservations = $pdo->query(
            'SELECT COUNT(*) AS total FROM reservations WHERE status != \'cancelled\''
        )->fetch();

        json_success([
            'site' => [
                'name'        => $settings['site_name']       ?? 'Shinjuku Gyoen',
                'tagline'     => $settings['tagline']         ?? '',
                'description' => $settings['description']     ?? '',
                'address'     => $settings['address']         ?? '',
                'season'      => $settings['season']          ?? '',
                'features'    => array_values(array_filter(array_map('trim', explode(',', $settings['features'] ?? '')))),
                'contact'     => [
                    'phone' => $settings['contact_phone'] ?? '',
                    'email' => $settings['contact_email'] ?? '',
                ],
            ],
            'visit' => [
                'opening_hour'  => $settings['opening_hour'] ?? '09:00',
                'closing_hour'  => $settings['closing_hour'] ?? '18:00',
                'ticket_price'  => (int)($settings['ticket_price'] ?? 0),
                'capacity_per_slot' => (int)($settings['capacity_per_slot'] ?? 100),
                'max_visitors_per_reservation' => (int)($settings['max_visitors_per_reservation'] ?? 10),
                'closed_weekday' => (int)($settings['closed_weekday'] ?? 1),
            ],
            'stats' => [
                'total_comments'   => (int)$agg['total'],
                'average_rating'   => round((float)$agg['average'], 1),
                'total_reservations' => (int)$reservations['total'],
            ],
        ]);
    }

    /**
     * GET /api/
     * Auto-documentation de l'API (pour les développeurs front-end).
     */
    public static function apiIndex(): void
    {
        $base = '/EXAMEN/api';

        json_success([
            'project'   => 'Shinjuku Gyoen - API PHP/MySQL',
            'version'   => '1.0',
            'base_url'  => $base,
            'note'      => 'L\'API est accessible sous la forme ' . $base . '/index.php?route=<endpoint>. Toutes les réponses sont en JSON. Les actions protégées exigent une session (cookie GYOEN_SESSION) créée via login/register.',
            'endpoints' => [
                'GET  ' . $base . '            ' => ['auth' => false, 'desc' => 'Cette documentation'],
                'GET  ' . $base . '/garden      ' => ['auth' => false, 'desc' => 'Informations sur le jardin (textes, horaires, prix, stats)'],
                'GET  ' . $base . '/availability' => ['auth' => false, 'desc' => 'Créneaux et places restantes pour une date (?date=YYYY-MM-DD)'],
                'GET  ' . $base . '/comments    ' => ['auth' => false, 'desc' => 'Liste des avis (public) + moyenne générale'],
                'POST ' . $base . '/register    ' => ['auth' => false, 'desc' => 'Créer un compte { username, email, password, full_name? }'],
                'POST ' . $base . '/login       ' => ['auth' => false, 'desc' => 'Se connecter { email, password } (email = identifiant ou pseudo)'],
                'POST ' . $base . '/logout      ' => ['auth' => false, 'desc' => 'Se déconnecter'],
                'GET  ' . $base . '/me          ' => ['auth' => true,  'desc' => 'Profil de l\'utilisateur connecté'],
                'GET  ' . $base . '/reservations' => ['auth' => true,  'desc' => 'Mes réservations'],
                'POST ' . $base . '/reservations' => ['auth' => true,  'desc' => 'Réserver { visit_date, visit_time, visitors }'],
                'DELETE ' . $base . '/reservations/{id}' => ['auth' => true, 'desc' => 'Annuler une de mes réservations'],
                'POST ' . $base . '/comments    ' => ['auth' => true,  'desc' => 'Poster un avis { rating: 1..5, content }'],
                'DELETE ' . $base . '/comments/{id}' => ['auth' => true, 'desc' => 'Supprimer mon avis'],
            ],
        ]);
    }
}
