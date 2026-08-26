<?php

declare(strict_types=1);

/**
 * ============================================================
 *  SHINJUKU GYOEN - Configuration Messagerie
 * ============================================================
 *  Le chat widget envoie les messages directement sur
 *  WhatsApp de l'admin via un lien wa.me.
 *
 *  Le visiteur clique sur le bouton WhatsApp → s'ouvre une
 *  conversation WhatsApp avec le message pré-rempli.
 *
 *  Pas besoin de compte, pas d'API, pas de vérification.
 * ============================================================
 */

// Numéro WhatsApp de l'admin (format international sans +)
// Ex: 25766061745
define('WHATSAPP_ADMIN_PHONE', '25766061745');

// Nom du site
define('SITE_NAME', 'Shinjuku Gyoen');

// Email admin (backup notifications)
define('ADMIN_EMAIL', 'iragame1@gmail.com');

/**
 * Vérifie si WhatsApp est configuré.
 */
function whatsapp_is_configured(): bool
{
    return WHATSAPP_ADMIN_PHONE !== '';
}

/**
 * Génère un lien WhatsApp Click-to-Chat.
 *
 * @param string $message Message pré-rempli
 * @return string URL wa.me
 */
function whatsapp_get_link(string $message = ''): string
{
    $phone = preg_replace('/[^0-9]/', '', WHATSAPP_ADMIN_PHONE);
    $url = 'https://wa.me/' . $phone;
    if ($message !== '') {
        $url .= '?text=' . urlencode($message);
    }
    return $url;
}

/**
 * Stub pour compatibilité (pas d'envoi API).
 */
function whatsapp_send_message(string $to, string $text): array
{
    return ['ok' => false, 'error' => 'Mode lien direct — utilisez wa.me'];
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

function whatsapp_verify_signature(string $signature, string $rawBody, string $token): bool { return true; }
function whatsapp_get_templates(string $wabaId = '', int $limit = 50, string $status = ''): array { return ['ok' => false]; }
function whatsapp_get_template(string $templateName): array { return ['ok' => false]; }
function whatsapp_send_template(string $to, string $templateName, string $langCode = 'fr', array $params = []): array { return ['ok' => false]; }
function whatsapp_delete_template(string $templateName): array { return ['ok' => false]; }
