<?php

declare(strict_types=1);

/**
 * ============================================================
 *  SHINJUKU GYOEN - Configuration Messagerie WhatsApp (Vonage)
 * ============================================================
 *  Utilise l'API Vonage Messages pour envoyer des notifications
 *  WhatsApp quand un visiteur écrit sur le site.
 *
 *  Le visiteur envoie un message sur le site → l'admin reçoit
 *  le message sur WhatsApp. L'admin répond sur admin.php.
 * ============================================================
 */

// ─── Vonage API ────────────────────────────────────────────
define('VONAGE_API_KEY', 'riwqBU2Vn4dA3yvg');
define('VONAGE_API_SECRET', 'pB08DgRXSmLPj6Xw!B2');

// Numéro Vonage (celui qui envoie les notifications)
define('VONAGE_WHATSAPP_FROM', '14157386102');

// Numéro WhatsApp de l'admin (celui qui REÇOIT les notifications)
// C'est VOTRE numéro perso — format international sans +
define('WHATSAPP_ADMIN_PHONE', '25766061745');

// Nom du site
define('SITE_NAME', 'Shinjuku Gyoen');

// Email admin (backup notifications)
define('ADMIN_EMAIL', 'iragame1@gmail.com');

/**
 * Vérifie si Vonage est configuré.
 */
function whatsapp_is_configured(): bool
{
    return VONAGE_API_KEY !== '' && VONAGE_API_SECRET !== '';
}

/**
 * Envoie un message WhatsApp via Vonage Messages API.
 *
 * @param string $to   Numéro destination (sans +)
 * @param string $text Contenu du message
 * @return array{ok: bool, error?: string, message_id?: string}
 */
function whatsapp_send_message(string $to, string $text): array
{
    if (!whatsapp_is_configured()) {
        return ['ok' => false, 'error' => 'Vonage non configuré.'];
    }

    // Nettoyer le numéro
    $to = preg_replace('/[^0-9]/', '', $to);

    $url = 'https://messages-api-us-1.vonage.com/v1/messages';

    $payload = json_encode([
        'from' => ['type' => 'whatsapp', 'number' => VONAGE_WHATSAPP_FROM],
        'to'   => ['type' => 'whatsapp', 'number' => $to],
        'channel' => 'whatsapp',
        'content' => [
            'type' => 'text',
            'text' => $text,
        ],
    ]);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'Accept: application/json',
        ],
        CURLOPT_USERPWD        => VONAGE_API_KEY . ':' . VONAGE_API_SECRET,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 15,
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($response === false) {
        return ['ok' => false, 'error' => 'Échec de la requête cURL.'];
    }

    $data = json_decode($response, true);

    if ($httpCode >= 200 && $httpCode < 300 && isset($data['message_uuid'])) {
        return ['ok' => true, 'message_id' => $data['message_uuid']];
    }

    $errorMsg = $data['error_title'] ?? $data['error'] ?? $response;
    return ['ok' => false, 'error' => 'Vonage (HTTP ' . $httpCode . '): ' . $errorMsg];
}

/**
 * Envoie un email de notification à l'admin.
 */
function notify_admin_email(string $visitorName, string $body, int $convId): bool
{
    if (ADMIN_EMAIL === '') {
        return false;
    }

    $subject = "Nouveau message de {$visitorName} — " . SITE_NAME;
    $siteUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http')
             . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
    $adminUrl = $siteUrl . '/admin.php';

    $html = "
    <div style='font-family: -apple-system, sans-serif; max-width: 600px; margin: 0 auto; background: #f9f9f6; border-radius: 12px; overflow: hidden; border: 1px solid #e0e0e0;'>
        <div style='background: #061b0e; padding: 20px 24px;'>
            <h1 style='color: #f9f9f6; font-size: 18px; margin: 0;'>Nouveau message — " . SITE_NAME . "</h1>
        </div>
        <div style='padding: 24px;'>
            <p style='color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.1em; margin: 0 0 4px;'>De</p>
            <p style='color: #1a1c1b; font-size: 16px; font-weight: 600; margin: 0 0 16px;'>{$visitorName}</p>
            <p style='color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.1em; margin: 0 0 4px;'>Message</p>
            <div style='background: #fff; border: 1px solid #e0e0e0; border-radius: 8px; padding: 16px; font-size: 15px; line-height: 1.5; color: #1a1c1b; margin: 0 0 20px;'>{$body}</div>
            <a href='{$adminUrl}' style='display: inline-block; background: #061b0e; color: #fff; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase;'>Répondre sur le site</a>
        </div>
        <div style='padding: 12px 24px; background: #eee; text-align: center; font-size: 11px; color: #999;'>
            Conversation #{$convId} · {$adminUrl}
        </div>
    </div>";

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . SITE_NAME . " <" . ADMIN_EMAIL . ">\r\n";

    return mail(ADMIN_EMAIL, $subject, $html, $headers);
}

/**
 * Vérifie la signature du webhook Vonage.
 */
function whatsapp_verify_signature(string $signature, string $rawBody, string $token): bool
{
    $expected = hash_hmac('sha256', $rawBody, $token);
    return hash_equals($expected, $signature);
}

// Stubs templates (non utilisés avec Vonage basic)
function whatsapp_get_templates(string $wabaId = '', int $limit = 50, string $status = ''): array { return ['ok' => false, 'error' => 'Non disponible.']; }
function whatsapp_get_template(string $templateName): array { return ['ok' => false, 'error' => 'Non disponible.']; }
function whatsapp_send_template(string $to, string $templateName, string $langCode = 'fr', array $params = []): array { return ['ok' => false, 'error' => 'Non disponible.']; }
function whatsapp_delete_template(string $templateName): array { return ['ok' => false, 'error' => 'Non disponible.']; }
