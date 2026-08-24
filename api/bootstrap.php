<?php

/**
 * ============================================================
 *  SHINJUKU GYOEN - API REST en PHP
 *  bootstrap.php : amorçage commun à tous les appels d'API
 * ============================================================
 *  - Session PHP (authentification par cookie HttpOnly/SameSite)
 *  - En-têtes JSON + CORS
 *  - Lecture du corps JSON de la requête
 *  - Fonctions utilitaires (réponses JSON, erreurs, auth)
 * ============================================================
 */

declare(strict_types=1);

require __DIR__ . '/../config/db.php';

/* ------------------------------------------------------------
 * Session sécurisée
 * ---------------------------------------------------------- */
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
    ]);
    session_name('GYOEN_SESSION');
    session_start();
}

/* ------------------------------------------------------------
 * En-têtes CORS (le front peut être servi du même domaine)
 * ---------------------------------------------------------- */
header('Access-Control-Allow-Origin: ' . (($_SERVER['HTTP_ORIGIN'] ?? '') !== '' ? $_SERVER['HTTP_ORIGIN'] : '*'));
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-CSRF-Token');

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
    http_response_code(204);
    exit;
}

/* ------------------------------------------------------------
 * Toutes les réponses de l'API sont en JSON
 * ---------------------------------------------------------- */
header('Content-Type: application/json; charset=utf-8');

/**
 * Lit et décode le corps JSON de la requête.
 *
 * @return array<string, mixed>
 */
function json_input(): array
{
    $raw = file_get_contents('php://input');
    if ($raw === false || trim($raw) === '') {
        return [];
    }
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

/**
 * Envoie une réponse JSON de succès et termine le script.
 *
 * @param mixed $data
 */
function json_success($data, int $status = 200): void
{
    http_response_code($status);
    echo json_encode(['success' => true, 'data' => $data], JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * Envoie une réponse JSON d'erreur et termine le script.
 */
function json_error(string $code, string $message, int $status = 400): void
{
    http_response_code($status);
    echo json_encode([
        'success' => false,
        'error'   => ['code' => $code, 'message' => $message],
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * Retourne l'utilisateur connecté (depuis la session) ou null.
 *
 * @return array<string, mixed>|null
 */
function current_user(): ?array
{
    if (empty($_SESSION['user_id'])) {
        return null;
    }
    $stmt = getPDO()->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    return $user ?: null;
}

/**
 * Exige un utilisateur connecté, sinon erreur 401.
 *
 * @return array<string, mixed>
 */
function require_auth(): array
{
    $user = current_user();
    if ($user === null) {
        json_error('unauthorized', 'Vous devez être connecté pour effectuer cette action.', 401);
    }
    return $user;
}

/**
 * Exige un utilisateur avec le rôle 'admin'.
 *
 * @return array<string, mixed>
 */
function require_admin(): array
{
    $user = require_auth();
    if (($user['role'] ?? 'user') !== 'admin') {
        json_error('forbidden', 'Accès réservé aux administrateurs.', 403);
    }
    return $user;
}

/**
 * Valide et renvoie une valeur de chaîne depuis le corps JSON.
 */
function str_field(array $data, string $key, int $max = 255, bool $required = true, int $min = 1): ?string
{
    $value = trim((string)($data[$key] ?? ''));
    if ($value === '') {
        if ($required) {
            json_error('missing_field', "Le champ '$key' est requis.");
        }
        return null;
    }
    if (mb_strlen($value) > $max) {
        json_error('invalid_field', "Le champ '$key' ne doit pas dépasser $max caractères.");
    }
    if (mb_strlen($value) < $min) {
        json_error('invalid_field', "Le champ '$key' doit contenir au moins $min caractère(s).");
    }
    return $value;
}

/**
 * Gestion d'erreurs globale : tout PDOException devient un 500 propre.
 */
function api_shutdown_handler(): void
{
    $error = error_get_last();
    if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=utf-8');
        }
        echo json_encode([
            'success' => false,
            'error'   => ['code' => 'internal_error', 'message' => 'Une erreur interne est survenue.'],
        ], JSON_UNESCAPED_UNICODE);
    }
}

register_shutdown_function('api_shutdown_handler');
