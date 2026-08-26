<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../../config/whatsapp.php';

/**
 * ============================================================
 *  MessageController : messagerie visiteur <-> admin (WhatsApp)
 * ============================================================
 *
 *  Endpoints :
 *    POST   /api/messages              – Envoyer un message (visiteur)
 *    GET    /api/messages/{convId}     – Lire les messages d'une conversation
 *    GET    /api/messages/poll/{convId}– Polling: nouveaux messages depuis un timestamp
 *    POST   /api/messages/webhook      – Webhook WhatsApp (réception réponses admin)
 *    GET    /api/messages/webhook      – Vérification du webhook (challenge Meta)
 *    GET    /api/admin/conversations   – Liste des conversations (admin)
 *    GET    /api/admin/messages/{id}   – Messages d'une conversation (admin)
 *    POST   /api/admin/messages/{id}   – Répondre depuis l'admin (stocké + envoyé WhatsApp)
 */

final class MessageController
{
    /* ================================================================
     *  POST /api/messages
     *  Corps : { visitor_name, visitor_phone?, visitor_email?, body }
     *  Crée une conversation si visitor_id absent, sinon ajoute un message.
     * ================================================================ */
    public static function store(): void
    {
        $in  = json_input();
        $pdo = getPDO();

        $name  = str_field($in, 'visitor_name', 120);
        $phone = $in['visitor_phone'] ?? null;
        $email = $in['visitor_email'] ?? null;
        $body  = str_field($in, 'body', 4000, true, 1);

        // Si un conversation_id est fourni, ajouter un message à la conversation existante
        $convId = isset($in['conversation_id']) ? (int)$in['conversation_id'] : 0;

        if ($convId > 0) {
            $stmt = $pdo->prepare('SELECT id FROM conversations WHERE id = ?');
            $stmt->execute([$convId]);
            if (!$stmt->fetch()) {
                json_error('not_found', 'Conversation introuvable.', 404);
            }
        } else {
            // Créer une nouvelle conversation
            $stmt = $pdo->prepare(
                'INSERT INTO conversations (visitor_name, visitor_phone, visitor_email)
                 VALUES (?, ?, ?)'
            );
            $stmt->execute([$name, $phone ?: null, $email ?: null]);
            $convId = (int)$pdo->lastInsertId();
        }

        // Insérer le message visiteur
        $stmt = $pdo->prepare(
            'INSERT INTO messages (conversation_id, sender, body)
             VALUES (?, "visitor", ?)'
        );
        $stmt->execute([$convId, $body]);

        $msgId = (int)$pdo->lastInsertId();

        // Envoyer à l'admin via WhatsApp
        $waResult = self::notifyAdminViaWhatsApp($convId, $name, $body);

        json_success([
            'conversation_id' => $convId,
            'message_id'      => $msgId,
            'whatsapp_sent'   => $waResult['ok'],
        ], 201);
    }

    /* ================================================================
     *  GET /api/messages/{id}
     *  Retourne tous les messages d'une conversation.
     * ================================================================ */
    public static function show(string $id): void
    {
        $pdo = getPDO();
        $convId = (int)$id;

        $stmt = $pdo->prepare('SELECT * FROM conversations WHERE id = ?');
        $stmt->execute([$convId]);
        $conv = $stmt->fetch();

        if (!$conv) {
            json_error('not_found', 'Conversation introuvable.', 404);
        }

        $stmt = $pdo->prepare(
            'SELECT id, sender, body, created_at
             FROM messages
             WHERE conversation_id = ?
             ORDER BY created_at ASC'
        );
        $stmt->execute([$convId]);
        $messages = $stmt->fetchAll();

        json_success([
            'conversation' => $conv,
            'messages'     => $messages,
        ]);
    }

    /* ================================================================
     *  GET /api/messages/poll/{id}?since=YYYY-MM-DD HH:MM:SS
     *  Retourne les messages plus récents que `since`.
     * ================================================================ */
    public static function poll(string $id): void
    {
        $convId = (int)$id;
        $since  = $_GET['since'] ?? '';
        $pdo    = getPDO();

        if ($since === '' || !preg_match('/^\d{4}-\d{2}-\d{2}[ T]\d{2}:\d{2}:\d{2}$/', $since)) {
            json_error('invalid_field', 'Le paramètre since est requis (format YYYY-MM-DD HH:MM:SS).');
        }

        $stmt = $pdo->prepare(
            'SELECT id, sender, body, created_at
             FROM messages
             WHERE conversation_id = ? AND created_at > ?
             ORDER BY created_at ASC'
        );
        $stmt->execute([$convId, $since]);

        json_success($stmt->fetchAll());
    }

    /* ================================================================
     *  POST /api/messages/webhook
     *  Webhook WhatsApp : réception des réponses admin.
     * ================================================================ */
    public static function webhook(): void
    {
        $rawBody = file_get_contents('php://input');
        $data    = json_decode($rawBody, true);

        // Vérification de signature (si configurée)
        $signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
        $appSecret = ''; // À remplir si nécessaire
        if ($appSecret !== '' && $signature !== '') {
            if (!whatsapp_verify_signature($signature, $rawBody, $appSecret)) {
                http_response_code(403);
                echo json_encode(['error' => 'Invalid signature']);
                exit;
            }
        }

        // Traiter les entrées WhatsApp
        if (isset($data['entry'][0]['changes'][0]['value']['messages'])) {
            $messages = $data['entry'][0]['changes'][0]['value']['messages'];

            foreach ($messages as $msg) {
                $from      = $msg['from'] ?? '';
                $body      = $msg['text']['body'] ?? '';
                $waMsgId   = $msg['id'] ?? '';

                if ($body === '') {
                    continue;
                }

                self::processIncomingWhatsAppMessage($from, $body, $waMsgId);
            }
        }

        // Toujours répondre 200 à Meta
        http_response_code(200);
        echo 'ok';
        exit;
    }

    /* ================================================================
     *  GET /api/messages/webhook
     *  Vérification du webhook (challenge Meta).
     * ================================================================ */
    public static function webhookVerify(): void
    {
        $mode      = $_GET['hub_mode'] ?? '';
        $token     = $_GET['hub_verify_token'] ?? '';
        $challenge = $_GET['hub_challenge'] ?? '';

        $expectedToken = 'SHINJUKU_GYOEN_VERIFY';

        if ($mode === 'subscribe' && $token === $expectedToken) {
            http_response_code(200);
            echo $challenge;
            exit;
        }

        http_response_code(403);
        echo 'Forbidden';
        exit;
    }

    /* ================================================================
     *  GET /api/admin/conversations
     *  Liste des conversations (admin seulement).
     * ================================================================ */
    public static function adminConversations(): void
    {
        require_admin();
        $pdo = getPDO();

        $stmt = $pdo->query(
            'SELECT c.*,
                    (SELECT COUNT(*) FROM messages m WHERE m.conversation_id = c.id) AS message_count,
                    (SELECT body FROM messages m WHERE m.conversation_id = c.id ORDER BY m.created_at DESC LIMIT 1) AS last_message,
                    (SELECT created_at FROM messages m WHERE m.conversation_id = c.id ORDER BY m.created_at DESC LIMIT 1) AS last_message_at
             FROM conversations c
             ORDER BY c.updated_at DESC'
        );

        json_success($stmt->fetchAll());
    }

    /* ================================================================
     *  GET /api/admin/messages/{id}
     *  Messages d'une conversation (admin).
     * ================================================================ */
    public static function adminMessages(string $id): void
    {
        require_admin();
        $convId = (int)$id;
        $pdo    = getPDO();

        $stmt = $pdo->prepare('SELECT * FROM conversations WHERE id = ?');
        $stmt->execute([$convId]);
        $conv = $stmt->fetch();

        if (!$conv) {
            json_error('not_found', 'Conversation introuvable.', 404);
        }

        $stmt = $pdo->prepare(
            'SELECT id, sender, body, created_at
             FROM messages
             WHERE conversation_id = ?
             ORDER BY created_at ASC'
        );
        $stmt->execute([$convId]);

        json_success([
            'conversation' => $conv,
            'messages'     => $stmt->fetchAll(),
        ]);
    }

    /* ================================================================
     *  POST /api/admin/messages/{id}
     *  Envoyer un message depuis l'admin.
     *  Corps : { body }
     * ================================================================ */
    public static function adminReply(string $id): void
    {
        require_admin();
        $in     = json_input();
        $pdo    = getPDO();
        $convId = (int)$id;

        $body = str_field($in, 'body', 4000, true, 1);

        $stmt = $pdo->prepare('SELECT * FROM conversations WHERE id = ?');
        $stmt->execute([$convId]);
        $conv = $stmt->fetch();

        if (!$conv) {
            json_error('not_found', 'Conversation introuvable.', 404);
        }

        // Insérer le message admin
        $stmt = $pdo->prepare(
            'INSERT INTO messages (conversation_id, sender, body)
             VALUES (?, "admin", ?)'
        );
        $stmt->execute([$convId, $body]);
        $msgId = (int)$pdo->lastInsertId();

        // Envoyer via WhatsApp si le visiteur a un numéro
        $waSent = false;
        if ($conv['visitor_phone'] && whatsapp_is_configured()) {
            $result = whatsapp_send_message($conv['visitor_phone'], $body);
            $waSent = $result['ok'];

            if ($waSent && isset($result['message_id'])) {
                $pdo->prepare('UPDATE messages SET whatsapp_message_id = ? WHERE id = ?')
                    ->execute([$result['message_id'], $msgId]);
            }
        }

        json_success([
            'message_id'    => $msgId,
            'whatsapp_sent' => $waSent,
        ], 201);
    }

    /* ================================================================
     *  POST /api/admin/conversations/{id}/close
     *  Fermer une conversation.
     * ================================================================ */
    public static function adminClose(string $id): void
    {
        require_admin();
        $pdo = getPDO();

        $stmt = $pdo->prepare('UPDATE conversations SET status = "closed" WHERE id = ?');
        $stmt->execute([(int)$id]);

        json_success(['id' => (int)$id, 'status' => 'closed']);
    }

    /* ================================================================
     *  GET /api/admin/whatsapp/templates
     *  Liste les templates WhatsApp Business (admin).
     * ================================================================ */
    public static function adminTemplates(): void
    {
        require_admin();

        $status = $_GET['status'] ?? '';
        $limit  = isset($_GET['limit']) ? max(1, min(100, (int)$_GET['limit'])) : 50;

        $result = whatsapp_get_templates(limit: $limit, status: $status);

        if (!$result['ok']) {
            json_error('whatsapp_error', $result['error']);
        }

        json_success([
            'templates' => $result['data'],
            'paging'    => $result['paging'] ?? null,
        ]);
    }

    /* ================================================================
     *  GET /api/admin/whatsapp/templates/{name}
     *  Détails d'un template WhatsApp (admin).
     * ================================================================ */
    public static function adminTemplateShow(string $name): void
    {
        require_admin();

        $result = whatsapp_get_template($name);

        if (!$result['ok']) {
            json_error('whatsapp_error', $result['error']);
        }

        if ($result['data'] === null) {
            json_error('not_found', 'Template introuvable.', 404);
        }

        json_success($result['data']);
    }

    /* ================================================================
     *  POST /api/admin/whatsapp/send-template
     *  Envoyer un message template WhatsApp.
     *  Corps : { to, template_name, lang?, params? }
     * ================================================================ */
    public static function adminSendTemplate(): void
    {
        require_admin();
        $in = json_input();

        $to           = str_field($in, 'to', 20);
        $templateName = str_field($in, 'template_name', 100);
        $langCode     = $in['lang'] ?? 'fr';
        $params       = $in['params'] ?? [];

        $result = whatsapp_send_template($to, $templateName, $langCode, $params);

        if (!$result['ok']) {
            json_error('whatsapp_error', $result['error']);
        }

        json_success([
            'to'           => $to,
            'template'     => $templateName,
            'message_id'   => $result['message_id'] ?? null,
        ], 201);
    }

    /* ================================================================
     *  DELETE /api/admin/whatsapp/templates/{name}
     *  Supprimer un template WhatsApp (admin).
     * ================================================================ */
    public static function adminTemplateDelete(string $name): void
    {
        require_admin();

        $result = whatsapp_delete_template($name);

        if (!$result['ok']) {
            json_error('whatsapp_error', $result['error']);
        }

        json_success(['deleted' => true, 'name' => $name]);
    }

    /* -------------------------------------------------------------- */
    /*  Méthodes privées                                              */
    /* -------------------------------------------------------------- */

    /**
     * Envoie une notification WhatsApp à l'admin quand un visiteur écrit.
     */
    private static function notifyAdminViaWhatsApp(int $convId, string $visitorName, string $body): array
    {
        if (!whatsapp_is_configured()) {
            return ['ok' => false, 'error' => 'WhatsApp non configuré'];
        }

        $text = "Nouveau message de *{$visitorName}* (conversation #{$convId}) :\n\n{$body}\n\n---\nRépondez directement ici, votre réponse apparaîtra sur le site.";

        return whatsapp_send_message(WHATSAPP_ADMIN_PHONE, $text);
    }

    /**
     * Traite un message entrant de WhatsApp (réponse admin).
     */
    private static function processIncomingWhatsAppMessage(string $from, string $body, string $waMsgId): void
    {
        $pdo = getPDO();

        // Chercher la dernière conversation ouverte
        $stmt = $pdo->prepare(
            'SELECT id FROM conversations WHERE status = "open" ORDER BY updated_at DESC LIMIT 1'
        );
        $stmt->execute();
        $conv = $stmt->fetch();

        if (!$conv) {
            return; // Pas de conversation ouverte, ignorer
        }

        $convId = (int)$conv['id'];

        // Vérifier si ce message n'est pas un doublon
        $stmt = $pdo->prepare('SELECT id FROM messages WHERE whatsapp_message_id = ?');
        $stmt->execute([$waMsgId]);
        if ($stmt->fetch()) {
            return; // Déjà traité
        }

        // Insérer le message admin
        $stmt = $pdo->prepare(
            'INSERT INTO messages (conversation_id, sender, body, whatsapp_message_id)
             VALUES (?, "admin", ?, ?)'
        );
        $stmt->execute([$convId, $body, $waMsgId]);

        // Mettre à jour la conversation
        $pdo->prepare('UPDATE conversations SET updated_at = NOW() WHERE id = ?')
            ->execute([$convId]);
    }
}
