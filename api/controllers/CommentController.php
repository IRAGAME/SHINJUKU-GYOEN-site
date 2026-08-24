<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

/**
 * ============================================================
 *  CommentController : avis / évaluations des visiteurs
 * ============================================================
 */

final class CommentController
{
    /**
     * GET /api/comments
     * Liste publique des avis (avec pseudo + moyenne générale).
     */
    public static function index(): void
    {
        $pdo = getPDO();

        $limit  = min(100, max(1, (int)($_GET['limit'] ?? 50)));
        $offset = max(0, (int)($_GET['offset'] ?? 0));

        $stmt = $pdo->prepare(
            'SELECT c.id, c.user_id, c.rating, c.content, c.created_at,
                    u.username, u.full_name
             FROM comments c
             JOIN users u ON u.id = c.user_id
             ORDER BY c.created_at DESC
             LIMIT ? OFFSET ?'
        );
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();

        $comments = array_map(function ($row) {
            $row['created_at_fr'] = date('d/m/Y à H:i', strtotime($row['created_at']));
            $row['author']        = $row['full_name'] ?: $row['username'];
            return $row;
        }, $stmt->fetchAll());

        $agg = $pdo->query(
            'SELECT COUNT(*) AS total, COALESCE(AVG(rating), 0) AS average FROM comments'
        )->fetch();

        $distribution = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
        foreach ($pdo->query('SELECT rating, COUNT(*) AS n FROM comments GROUP BY rating')->fetchAll() as $row) {
            $distribution[(int)$row['rating']] = (int)$row['n'];
        }

        json_success([
            'comments'          => $comments,
            'total_comments'    => (int)$agg['total'],
            'average_rating'    => round((float)$agg['average'], 1),
            'distribution'      => $distribution,
            'limit'             => $limit,
            'offset'            => $offset,
        ]);
    }

    /**
     * POST /api/comments
     * Corps : { rating: 1..5, content }
     */
    public static function store(): void
    {
        $user = require_auth();
        $in   = json_input();

        $rating  = (int)($in['rating'] ?? 0);
        $content = str_field($in, 'content', 1000);

        if ($rating < 1 || $rating > 5) {
            json_error('invalid_field', 'La note doit être comprise entre 1 et 5.');
        }

        $stmt = getPDO()->prepare(
            'INSERT INTO comments (user_id, rating, content) VALUES (?, ?, ?)'
        );
        $stmt->execute([$user['id'], $rating, $content]);

        $stmt = getPDO()->prepare(
            'SELECT c.id, c.user_id, c.rating, c.content, c.created_at,
                    u.username, u.full_name
             FROM comments c
             JOIN users u ON u.id = c.user_id
             WHERE c.id = ?'
        );
        $stmt->execute([getPDO()->lastInsertId()]);
        $comment = $stmt->fetch();

        $comment['created_at_fr'] = date('d/m/Y à H:i', strtotime($comment['created_at']));
        $comment['author']        = $comment['full_name'] ?: $comment['username'];

        json_success($comment, 201);
    }

    /**
     * DELETE /api/comments/{id}
     * Supprime son propre avis (un admin peut tout supprimer).
     */
    public static function destroy(string $id): void
    {
        $user = require_auth();
        $pdo  = getPDO();

        $stmt = $pdo->prepare('SELECT * FROM comments WHERE id = ?');
        $stmt->execute([(int)$id]);
        $comment = $stmt->fetch();

        if (!$comment) {
            json_error('not_found', 'Avis introuvable.', 404);
        }
        $isAdmin = (($user['role'] ?? 'user') === 'admin');
        if ((int)$comment['user_id'] !== (int)$user['id'] && !$isAdmin) {
            json_error('forbidden', 'Vous ne pouvez supprimer que vos propres avis.', 403);
        }

        $pdo->prepare('DELETE FROM comments WHERE id = ?')->execute([(int)$id]);

        json_success(['message' => 'Avis supprimé.']);
    }
}
