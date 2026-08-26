<?php

declare(strict_types=1);

/**
 * ============================================================
 *  SHINJUKU GYOEN - Configuration WhatsApp via Twilio
 * ============================================================
 *  Twilio permet d'envoyer des messages WhatsApp sans compte
 *  Meta Business vérifié. Le mode "Sandbox" (gratuit) suffit
 *  pour les tests et projets étudiants.
 *
 *  Comment démarrer :
 *  1. Créez un compte gratuit : https://www.twilio.com/try-twilio
 *  2. Allez dans Console → Messaging → WhatsApp → Try out WhatsApp
 *  3. Scannez le QR code ou envoyez le message "join <mot>" au numéro Twilio
 *  4. Copiez votre Account SID et Auth Token depuis twilio.com/console
 *  5. Copiez le numéro WhatsApp Twilio (format: +14155238886)
 *  6. Remplissez les constantes ci-dessous
 * ============================================================
 */

// Account SID — twilio.com/console (commence par "AC")
define('TWILIO_ACCOUNT_SID', '');

// Auth Token — twilio.com/console
define('TWILIO_AUTH_TOKEN', '');

// Numéro WhatsApp Twilio (Sandbox)
// En trial : +14155238886 (numéro Twilio par défaut)
// En prod : votre propre numéro Twilio WhatsApp
define('TWILIO_WHATSAPP_FROM', 'whatsapp:+14155238886');

// Numéro WhatsApp de l'admin (format international avec +)
define('WHATSAPP_ADMIN_PHONE', 'whatsapp:+25766061745');

// URL de base de l'API Twilio
define('TWILIO_API_BASE', 'https://api.twilio.com/2010-04-01');

/**
 * Vérifie si Twilio est configuré.
 */
function whatsapp_is_configured(): bool
{
    return TWILIO_ACCOUNT_SID !== '' && TWILIO_AUTH_TOKEN !== '';
}

/**
 * Envoie un message texte via Twilio WhatsApp.
 *
 * @param string $to   Numéro WhatsApp destination (format: whatsapp:+XXXXXXXXXX)
 * @param string $text Contenu du message
 * @return array{ok: bool, error?: string, message_id?: string}
 */
function whatsapp_send_message(string $to, string $text): array
{
    if (!whatsapp_is_configured()) {
        return ['ok' => false, 'error' => 'Twilio WhatsApp non configuré.'];
    }

    // S'assurer que le numéro a le préfixe whatsapp:
    if (strpos($to, 'whatsapp:') !== 0) {
        $to = 'whatsapp:' . ltrim($to, '+');
    }

    $url = TWILIO_API_BASE . '/Accounts/' . TWILIO_ACCOUNT_SID . '/Messages.json';

    $payload = http_build_query([
        'From' => TWILIO_WHATSAPP_FROM,
        'To'   => $to,
        'Body' => $text,
    ]);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/x-www-form-urlencoded',
        ],
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
 * Vérifie la signature du webhook Twilio (sécurité).
 */
function whatsapp_verify_signature(string $signature, string $rawBody, string $token): bool
{
    $expected = hash_hmac('sha1', $rawBody, $token);
    return hash_equals('sha1=' . $expected, $signature);
}

/**
 * Récupère la liste des templates WhatsApp pour un WABA.
 * (Non disponible via Twilio Sandbox — retourne une erreur explicative)
 */
function whatsapp_get_templates(string $wabaId = '', int $limit = 50, string $status = ''): array
{
    return [
        'ok'    => false,
        'error' => 'Les templates Meta ne sont pas disponibles via Twilio. Utilisez le mode texte libre avec Twilio Sandbox.',
    ];
}

/**
 * Récupère les détails d'un template spécifique.
 */
function whatsapp_get_template(string $templateName): array
{
    return [
        'ok'    => false,
        'error' => 'Les templates Meta ne sont pas disponibles via Twilio.',
    ];
}

/**
 * Envoie un message template via Twilio WhatsApp.
 * En mode Sandbox, Twilio utilise ses propres templates (via ContentSid).
 *
 * @param string $to           Numéro destination (format: whatsapp:+XXXXXXXXXX)
 * @param string $templateName Nom du template Twilio (ContentSid ou nom)
 * @param string $langCode     Code langue (non utilisé par Twilio directement)
 * @param array  $params       Variables du template [key => value]
 * @return array{ok: bool, error?: string, message_id?: string}
 */
function whatsapp_send_template(string $to, string $templateName, string $langCode = 'fr', array $params = []): array
{
    if (!whatsapp_is_configured()) {
        return ['ok' => false, 'error' => 'Twilio WhatsApp non configuré.'];
    }

    // S'assurer que le numéro a le préfixe whatsapp:
    if (strpos($to, 'whatsapp:') !== 0) {
        $to = 'whatsapp:' . ltrim($to, '+');
    }

    $url = TWILIO_API_BASE . '/Accounts/' . TWILIO_ACCOUNT_SID . '/Messages.json';

    $payloadData = [
        'From'      => TWILIO_WHATSAPP_FROM,
        'To'        => $to,
        'ContentSid' => $templateName,
    ];

    // Variables du template (ContentVariables)
    if (!empty($params)) {
        $variables = [];
        $i = 1;
        foreach ($params as $value) {
            $variables[(string)$i] = (string)$value;
            $i++;
        }
        $payloadData['ContentVariables'] = json_encode($variables);
    }

    $payload = http_build_query($payloadData);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/x-www-form-urlencoded',
        ],
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
 * Supprime un template WhatsApp. (Non supporté via Twilio)
 */
function whatsapp_delete_template(string $templateName): array
{
    return [
        'ok'    => false,
        'error' => 'La suppression de templates n\'est pas disponible via Twilio.',
    ];
}
