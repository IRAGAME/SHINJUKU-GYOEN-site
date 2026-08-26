<?php

declare(strict_types=1);

/**
 * ============================================================
 *  SHINJUKU GYOEN - Configuration Messagerie
 * ============================================================
 *  Le système fonctionne en 2 modes :
 *
 *  1. MODE EMAIL (par défaut, aucune config requise)
 *     Les messages visiteurs sont stockés en BDD.
 *     Un email de notification est envoyé à l'admin.
 *
 *  2. MODE TWILIO/WHATSAPP (optionnel)
 *     Les messages sont aussi envoyés sur WhatsApp.
 *     Nécessite un compte Twilio gratuit.
 * ============================================================
 */

// ─── Mode de notification ──────────────────────────────────
// 'email'  = notifications par email (par défaut, marche sans config)
// 'whatsapp' = notifications via Twilio WhatsApp (optionnel)
// 'both'   = email + WhatsApp
define('NOTIFICATION_MODE', 'email');

// ─── Admin ─────────────────────────────────────────────────
// Email qui reçoit les notifications
define('ADMIN_EMAIL', 'iragame1@gmail.com');

// Nom affiché dans les emails
define('ADMIN_NAME', 'Shinjuku Gyoen');

// ─── Twilio WhatsApp (optionnel) ───────────────────────────
// Remplissez uniquement si NOTIFICATION_MODE = 'whatsapp' ou 'both'
define('TWILIO_ACCOUNT_SID', '');
define('TWILIO_AUTH_TOKEN', '');
define('TWILIO_WHATSAPP_FROM', 'whatsapp:+14155238886');
define('WHATSAPP_ADMIN_PHONE', 'whatsapp:+25766061745');

/**
 * Vérifie si les notifications WhatsApp sont configurées.
 */
function whatsapp_is_configured(): bool
{
    return TWILIO_ACCOUNT_SID !== '' && TWILIO_AUTH_TOKEN !== '';
}

/**
 * Vérifie si les notifications par email sont activées.
 */
function email_is_configured(): bool
{
    return ADMIN_EMAIL !== '' && (NOTIFICATION_MODE === 'email' || NOTIFICATION_MODE === 'both');
}

/**
 * Envoie un email de notification à l'admin.
 *
 * @param string $visitorName  Nom du visiteur
 * @param string $body         Message du visiteur
 * @param int    $convId       ID de la conversation
 * @return bool
 */
function notify_admin_email(string $visitorName, string $body, int $convId): bool
{
    if (!email_is_configured()) {
        return false;
    }

    $subject = "Nouveau message de {$visitorName} — Shinjuku Gyoen";
    $siteUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http')
             . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
    $adminUrl = $siteUrl . '/admin.php';

    $html = "
    <div style='font-family: -apple-system, sans-serif; max-width: 600px; margin: 0 auto; background: #f9f9f6; border-radius: 12px; overflow: hidden; border: 1px solid #e0e0e0;'>
        <div style='background: #061b0e; padding: 20px 24px;'>
            <h1 style='color: #f9f9f6; font-size: 18px; margin: 0;'>Shinjuku Gyoen — Nouveau message</h1>
        </div>
        <div style='padding: 24px;'>
            <p style='color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.1em; margin: 0 0 4px;'>De</p>
            <p style='color: #1a1c1b; font-size: 16px; font-weight: 600; margin: 0 0 16px;'>{$visitorName}</p>
            <p style='color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.1em; margin: 0 0 4px;'>Message</p>
            <div style='background: #fff; border: 1px solid #e0e0e0; border-radius: 8px; padding: 16px; font-size: 15px; line-height: 1.5; color: #1a1c1b; margin: 0 0 20px;'>{$body}</div>
            <a href='{$adminUrl}' style='display: inline-block; background: #061b0e; color: #fff; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase;'>Répondre</a>
        </div>
        <div style='padding: 12px 24px; background: #eee; text-align: center; font-size: 11px; color: #999;'>
            Conversation #{$convId} · {$adminUrl}
        </div>
    </div>";

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . ADMIN_NAME . " <" . ADMIN_EMAIL . ">\r\n";
    $headers .= "Reply-To: " . ADMIN_EMAIL . "\r\n";

    return mail(ADMIN_EMAIL, $subject, $html, $headers);
}

/**
 * Envoie un message WhatsApp via Twilio.
 *
 * @param string $to   Numéro WhatsApp (format: whatsapp:+XXXXXXXXXX)
 * @param string $text Contenu du message
 * @return array{ok: bool, error?: string, message_id?: string}
 */
function whatsapp_send_message(string $to, string $text): array
{
    if (!whatsapp_is_configured()) {
        return ['ok' => false, 'error' => 'Twilio WhatsApp non configuré.'];
    }

    if (strpos($to, 'whatsapp:') !== 0) {
        $to = 'whatsapp:' . ltrim($to, '+');
    }

    $url = 'https://api.twilio.com/2010-04-01/Accounts/' . TWILIO_ACCOUNT_SID . '/Messages.json';

    $payload = http_build_query([
        'From' => TWILIO_WHATSAPP_FROM,
        'To'   => $to,
        'Body' => $text,
    ]);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
        CURLOPT_USERPWD        => TWILIO_ACCOUNT_SID . ':' . TWILIO_AUTH_TOKEN,
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

    if ($httpCode >= 200 && $httpCode < 300 && isset($data['sid'])) {
        return ['ok' => true, 'message_id' => $data['sid']];
    }

    $errorMsg = $data['message'] ?? $data['error_message'] ?? 'Erreur inconnue';
    return ['ok' => false, 'error' => $errorMsg];
}

/**
 * Vérifie la signature du webhook Twilio.
 */
function whatsapp_verify_signature(string $signature, string $rawBody, string $token): bool
{
    $expected = hash_hmac('sha1', $rawBody, $token);
    return hash_equals('sha1=' . $expected, $signature);
}

/**
 * Fonctions templates (non disponibles en mode email, stubs pour compatibilité).
 */
function whatsapp_get_templates(string $wabaId = '', int $limit = 50, string $status = ''): array
{
    return ['ok' => false, 'error' => 'Templates non disponibles en mode email.'];
}

function whatsapp_get_template(string $templateName): array
{
    return ['ok' => false, 'error' => 'Templates non disponibles en mode email.'];
}

function whatsapp_send_template(string $to, string $templateName, string $langCode = 'fr', array $params = []): array
{
    return ['ok' => false, 'error' => 'Templates non disponibles en mode email.'];
}

function whatsapp_delete_template(string $templateName): array
{
    return ['ok' => false, 'error' => 'Templates non disponibles en mode email.'];
}
