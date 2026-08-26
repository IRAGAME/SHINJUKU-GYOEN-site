<?php

declare(strict_types=1);

/**
 * ============================================================
 *  SHINJUKU GYOEN - API REST
 *  index.php : routeur principal (point d'entrée unique)
 * ============================================================
 *  Accès possibles (Apache, sans réécriture) :
 *      /EXAMEN/api/index.php?route=login
 *      /EXAMEN/api/index.php/reservations
 * ============================================================
 */

require __DIR__ . '/bootstrap.php';
require __DIR__ . '/controllers/AuthController.php';
require __DIR__ . '/controllers/ReservationController.php';
require __DIR__ . '/controllers/CommentController.php';
require __DIR__ . '/controllers/InfoController.php';
require __DIR__ . '/controllers/MessageController.php';

/* ------------------------------------------------------------
 *  Résolution de la "route" demandée
 * ---------------------------------------------------------- */
function resolve_route(): string
{
    if (!empty($_GET['route'])) {
        $route = (string)$_GET['route'];
        $route = strtok($route, '?') ?: $route;
        return '/' . trim($route, '/');
    }

    $pathInfo = trim((string)($_SERVER['PATH_INFO'] ?? ''));
    if ($pathInfo !== '') {
        return '/' . trim($pathInfo, '/');
    }

    $uri    = (string)parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $script = str_replace('\\', '/', (string)($_SERVER['SCRIPT_NAME'] ?? ''));

    if ($script !== '' && $script !== '/' && strpos($uri, $script) === 0) {
        $rest = substr($uri, strlen($script));
        if ($rest !== '') {
            return '/' . trim($rest, '/');
        }
    }

    return '/';
}

/* ------------------------------------------------------------
 *  Table de routage : [MÉTHODE, pattern, [Contrôleur, action]]
 * ---------------------------------------------------------- */
$routes = [
    ['GET',    '',                  [InfoController::class, 'apiIndex']],
    ['GET',    'garden',            [InfoController::class, 'garden']],
    ['GET',    'availability',      [ReservationController::class, 'availability']],
    ['GET',    'comments',          [CommentController::class, 'index']],
    ['POST',   'register',          [AuthController::class, 'register']],
    ['POST',   'login',             [AuthController::class, 'login']],
    ['POST',   'logout',            [AuthController::class, 'logout']],
    ['GET',    'me',                [AuthController::class, 'me']],
    ['GET',    'reservations',      [ReservationController::class, 'index']],
    ['POST',   'reservations',      [ReservationController::class, 'store']],
    ['DELETE', 'reservations/{id}', [ReservationController::class, 'cancel']],
    ['POST',   'comments',          [CommentController::class, 'store']],
    ['DELETE', 'comments/{id}',     [CommentController::class, 'destroy']],
    // Messagerie WhatsApp
    ['POST',   'messages',          [MessageController::class, 'store']],
    ['GET',    'messages/{id}',     [MessageController::class, 'show']],
    ['GET',    'messages/poll/{id}',[MessageController::class, 'poll']],
    ['POST',   'messages/webhook',  [MessageController::class, 'webhook']],
    ['GET',    'messages/webhook',  [MessageController::class, 'webhookVerify']],
    // Admin messagerie
    ['GET',    'admin/conversations',                      [MessageController::class, 'adminConversations']],
    ['GET',    'admin/messages/{id}',                      [MessageController::class, 'adminMessages']],
    ['POST',   'admin/messages/{id}',                      [MessageController::class, 'adminReply']],
    ['POST',   'admin/conversations/{id}/close',           [MessageController::class, 'adminClose']],
];

/* ------------------------------------------------------------
 *  Correspondance route <-> contrôleur
 * ---------------------------------------------------------- */
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path   = resolve_route();
$path   = $path === '/' ? '' : ltrim($path, '/');
$segments = $path === '' ? [] : explode('/', $path);

foreach ($routes as [$routeMethod, $pattern, $handler]) {
    if ($method !== $routeMethod) {
        continue;
    }

    $patternSegments = $pattern === '' ? [] : explode('/', $pattern);

    if (count($patternSegments) !== count($segments)) {
        continue;
    }

    $params = [];
    $match  = true;
    foreach ($patternSegments as $i => $patternSegment) {
        if (str_starts_with($patternSegment, '{')) {
            $params[] = $segments[$i];
            continue;
        }
        if ($patternSegment !== $segments[$i]) {
            $match = false;
            break;
        }
    }

    if ($match) {
        [$class, $action] = $handler;
        call_user_func_array([new $class(), $action], $params);
        exit;
    }
}

/* ------------------------------------------------------------
 *  Aucune route ne correspond
 * ---------------------------------------------------------- */
json_error('not_found', 'Endpoint introuvable. Consultez /EXAMEN/api pour la liste des routes.', 404);
