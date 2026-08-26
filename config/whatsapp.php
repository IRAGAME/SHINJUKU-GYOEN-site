<?php

declare(strict_types=1);

/**
 * ============================================================
 *  SHINJUKU GYOEN - Configuration Messagerie WhatsApp
 * ============================================================
 *  Utilise CallMeBot API (gratuit, pas de compte requis).
 *
 *  Comment activer (2 minutes) :
 *  1. Ouvrez WhatsApp sur votre téléphone
 *  2. Envoyez un message au numéro : +34 644 71 81 91
 *  3. Envoyez exactement : "I allow callmebot to send me messages"
 *  4. Vous recevrez un message avec votre API Key
 *  5. Copiez cette clé et collez-la ci-dessous
 *
 *  Ensuite :
 *  - Le prof envoie un message sur votre site
 *  - Vous recevez le message sur WhatsApp via CallMeBot
 *  - Vous répondez depuis le site admin (admin.php)
 * ============================================================
 */

// API Key CallMeBot (reçue après avoir envoyé le message d'activation)
// Format : "apikey=XXXXXXXXX"
define('CALLMEBOT_API_KEY', '');

// Numéro WhatsApp de l'admin (format international sans +)
// Ex: 25766061745
define('CALLMEBOT_PHONE', '25766061745');

// Email admin pour backup (reçoit aussi les notifications)
define('ADMIN_EMAIL', 'iragame1@gmail.com');

// Nom du site
define('SITE_NAME', 'Shinjuku Gyoen');

/**
 * Vérifie si CallMeBot est configuré.
 */
function whatsapp_is_configured(): bool
{
    return CALLMEBOT_API_KEY !== '';
}

/**
 * Envoie un message WhatsApp via CallMeBot.
 *
 * @param string $to   Numéro destination (format: 25766061745)
 * @param string $text Contenu du message
 * @return array{ok: bool, error?: string, message_id?: string}
 */
function whatsapp_send_message(string $to, string $text): array
{
    if (!whatsapp_is_configured()) {
        return ['ok' => false, 'error' => 'CallMeBot non configuré. Envoyez "I allow callmebot to send me messages" au +34 644 71 81 91 sur WhatsApp.'];
    }

    // Nettoyer le numéro
    $phone = preg_replace('/[^0-9]/', '', $to);

    $url = 'https://api.callmebot.com/whatsapp.php?source=php'
         . '&phone=' . urlencode($phone)
         . '&text=' . urlencode($text)
         . '&apikey=' . urlencode(CALLMEBOT_API_KEY);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 15,
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($response === false) {
        return ['ok' => false, 'error' => 'Échec de la requête cURL.'];
    }

    // CallMeBot retourne le message envoyé en cas de succès
    if ($httpCode >= 200 && $httpCode < 300) {
        return ['ok' => true, 'message_id' => 'callmebot_' . time()];
    }

    return ['ok' => false, 'error' => 'Erreur CallMeBot (HTTP ' . $httpCode . '): ' . ($response ?: 'Inconnue')];
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
 * Vérifie la signature du webhook (stub pour compatibilité).
 */
function whatsapp_verify_signature(string $signature, string $rawBody, string $token): bool
{
    return true;
}

// Stubs pour les templates (non utilisés)
function whatsapp_get_templates(string $wabaId = '', int $limit = 50, string $status = ''): array
{
    return ['ok' => false, 'error' => 'Non disponible avec CallMeBot.'];
}
function whatsapp_get_template(string $templateName): array
{
    return ['ok' => false, 'error' => 'Non disponible avec CallMeBot.'];
}
function whatsapp_send_template(string $to, string $templateName, string $langCode = 'fr', array $params = []): array
{
    return ['ok' => false, 'error' => 'Non disponible avec CallMeBot.'];
}
function whatsapp_delete_template(string $templateName): array
{
    return ['ok' => false, 'error' => 'Non disponible avec CallMeBot.'];
}
