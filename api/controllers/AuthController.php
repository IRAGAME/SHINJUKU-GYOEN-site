<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

/**
 * ============================================================
 *  AuthController : inscription, connexion, déconnexion
 * ============================================================
 */

final class AuthController
{
    /**
     * POST /api/register
     * Corps : { username, email, password, full_name? }
     */
    public static function register(): void
    {
        $in  = json_input();
        $pdo = getPDO();

        $username = str_field($in, 'username', 60);
        $email    = str_field($in, 'email', 190);
        $password = str_field($in, 'password', 255, true, 6);
        $fullName = str_field($in, 'full_name', 120, false);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            json_error('invalid_field', "L'adresse email n'est pas valide.");
        }
        if (!preg_match('/^[a-zA-Z0-9_]{3,60}$/', $username)) {
            json_error('invalid_field', "Le nom d'utilisateur doit contenir 3 à 60 caractères (lettres, chiffres, _).");
        }

        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? OR username = ?');
        $stmt->execute([$email, $username]);
        if ($stmt->fetch()) {
            json_error('conflict', 'Un compte existe déjà avec cet email ou ce nom d\'utilisateur.', 409);
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(
            'INSERT INTO users (username, email, password_hash, full_name) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$username, $email, $hash, $fullName]);

        $userId = (int)$pdo->lastInsertId();
        self::loginUser($userId);

        json_success(self::publicUser($userId), 201);
    }

    /**
     * POST /api/login
     * Corps : { email, password }   (email peut être le nom d'utilisateur)
     */
    public static function login(): void
    {
        $in = json_input();

        $identifier = str_field($in, 'email', 190);
        $password   = str_field($in, 'password', 255, true, 1);

        $pdo = getPDO();

        /* Anti force brute : 5 échecs => blocage 60 secondes */
        $attempts = (int)($_SESSION['login_attempts'] ?? 0);
        $lockedAt = (int)($_SESSION['login_locked_at'] ?? 0);

        if ($attempts >= 5 && (time() - $lockedAt) < 60) {
            json_error('too_many_attempts', 'Trop de tentatives. Réessayez dans 60 secondes.', 429);
        }
        if ($attempts >= 5) {
            $_SESSION['login_attempts'] = 0;
            $_SESSION['login_locked_at'] = 0;
        }

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? OR username = ?');
        $stmt->execute([$identifier, $identifier]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
            $_SESSION['login_locked_at'] = time();
            json_error('invalid_credentials', 'Email ou mot de passe incorrect.', 401);
        }

        $_SESSION['login_attempts'] = 0;
        $_SESSION['login_locked_at'] = 0;
        self::loginUser((int)$user['id']);

        json_success(self::publicUser((int)$user['id']));
    }

    /**
     * POST /api/logout
     */
    public static function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        json_success(['message' => 'Vous êtes déconnecté.']);
    }

    /**
     * GET /api/me
     */
    public static function me(): void
    {
        $user = current_user();
        if ($user === null) {
            json_error('unauthorized', 'Non connecté.', 401);
        }
        json_success(self::publicUser((int)$user['id']));
    }

    /* ---------------------------------------------------------- */

    private static function loginUser(int $userId): void
    {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $userId;
    }

    /**
     * Renvoie l'utilisateur sans jamais exposer le mot de passe.
     *
     * @return array<string, mixed>
     */
    private static function publicUser(int $userId): array
    {
        $stmt = getPDO()->prepare(
            'SELECT id, username, email, full_name, role, created_at FROM users WHERE id = ?'
        );
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }
}
