<?php

declare(strict_types=1);

/**
 * ============================================================
 *  SHINJUKU GYOEN - Configuration WhatsApp Business API
 * ============================================================
 *  Pour activer l'intégration WhatsApp, vous devez :
 *  1. Créer un compte Meta Business (business.facebook.com)
 *  2. Activer WhatsApp Business Platform
 *  3. Configurer un numéro de téléphone WhatsApp Business
 *  4. Créer une application Meta et obtenir un Access Token
 *  5. Configurer un webhook URL pointing vers :
 *     https://votre-domaine/api/index.php?route=messages/webhook
 *
 *  Une fois fait, remplissez les constantes ci-dessous.
 * ============================================================
 */

// Token d'accès à l'API Cloud WhatsApp (Meta)
// Généré dans Meta Developer Dashboard > WhatsApp > API Setup
define('WHATSAPP_API_TOKEN', '');

// Numéro de téléphone WhatsApp Business (format: sans + ni espaces)
// Ex: 25766061745
define('WHATSAPP_PHONE_NUMBER_ID', '');

// Numéro WhatsApp de l'admin qui reçoit les messages (format international avec +)
// Ex: +25766061745
define('WHATSAPP_ADMIN_PHONE', '+25766061745');

// Identifiant du WhatsApp Business Account (trouvable dans Meta Business Manager)
define('WHATSAPP_BUSINESS_ACCOUNT_ID', '');

// URL de base de l'API WhatsApp Cloud
define('WHATSAPP_API_BASE', 'https://graph.facebook.com/v18.0');

/**
 * Vérifie si l'API WhatsApp est configurée.
 */
function whatsapp_is_configured(): bool
{
    return WHATSAPP_API_TOKEN !== '' && WHATSAPP_PHONE_NUMBER_ID !== '';
}

/**
 * Envoie un message texte via l'API WhatsApp Cloud.
 *
 * @param string $to      Numéro de destination (avec +)
 * @param string $text    Contenu du message
 * @return array{ok: bool, error?: string, message_id?: string}
 */
function whatsapp_send_message(string $to, string $text): array
{
    if (!whatsapp_is_configured()) {
        return ['ok' => false, 'error' => 'WhatsApp API non configurée.'];
    }

    // Nettoyer le numéro : garder que les chiffres
    $toClean = preg_replace('/[^0-9]/', '', $to);

    $url = WHATSAPP_API_BASE . '/' . WHATSAPP_PHONE_NUMBER_ID . '/messages';

    $payload = [
        'messaging_product' => 'whatsapp',
        'to'                => $toClean,
        'type'              => 'text',
        'text'              => ['body' => $text],
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . WHATSAPP_API_TOKEN,
            'Content-Type: application/json',
        ],
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

    if ($httpCode >= 200 && $httpCode < 300 && isset($data['messages'][0]['id'])) {
        return ['ok' => true, 'message_id' => $data['messages'][0]['id']];
    }

    $errorMsg = $data['error']['message'] ?? 'Erreur inconnue';
    return ['ok' => false, 'error' => $errorMsg];
}

/**
 * Vérifie la signature du webhook WhatsApp (sécurité).
 *
 * @param string $signature  En-tête X-Hub-Signature-256
 * @param string $rawBody    Corps brut de la requête
 * @param string $secret     Clé secrète du webhook (app secret)
 */
function whatsapp_verify_signature(string $signature, string $rawBody, string $secret): bool
{
    if ($secret === '') {
        return true; // Pas de secret configuré = pas de vérification
    }
    $expected = 'sha256=' . hash_hmac('sha256', $rawBody, $secret);
    return hash_equals($expected, $signature);
}

/**
 * Récupère la liste des templates WhatsApp pour un WABA.
 *
 * @param string $wabaId   WhatsApp Business Account ID (optionnel, utilise la constante par défaut)
 * @param int    $limit    Nombre max de résultats (défaut 50)
 * @param string $status   Filtrer par status : APPROVED, PENDING, REJECTED, VIDEO_IN_PROCESS (vide = tous)
 * @return array{ok: bool, error?: string, data?: array}
 */
function whatsapp_get_templates(string $wabaId = '', int $limit = 50, string $status = ''): array
{
    if (!whatsapp_is_configured()) {
        return ['ok' => false, 'error' => 'WhatsApp API non configurée.'];
    }

    $wabaId = $wabaId ?: WHATSAPP_BUSINESS_ACCOUNT_ID;
    if ($wabaId === '') {
        return ['ok' => false, 'error' => 'WhatsApp Business Account ID non configuré.'];
    }

    $params = ['limit' => $limit];
    if ($status !== '') {
        $params['status'] = $status;
    }

    $url = WHATSAPP_API_BASE . '/' . $wabaId . '/message_templates?' . http_build_query($params);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . WHATSAPP_API_TOKEN,
        ],
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

    if ($httpCode >= 200 && $httpCode < 300) {
        return [
            'ok'   => true,
            'data' => $data['data'] ?? [],
            'paging' => $data['paging'] ?? null,
        ];
    }

    $errorMsg = $data['error']['message'] ?? 'Erreur inconnue';
    return ['ok' => false, 'error' => $errorMsg];
}

/**
 * Récupère les détails d'un template spécifique.
 *
 * @param string $templateName  Nom du template (ex: "reservation_confirm")
 * @return array{ok: bool, error?: string, data?: array}
 */
function whatsapp_get_template(string $templateName): array
{
    if (!whatsapp_is_configured()) {
        return ['ok' => false, 'error' => 'WhatsApp API non configurée.'];
    }

    $wabaId = WHATSAPP_BUSINESS_ACCOUNT_ID;
    if ($wabaId === '') {
        return ['ok' => false, 'error' => 'WhatsApp Business Account ID non configuré.'];
    }

    $url = WHATSAPP_API_BASE . '/' . $wabaId . '/message_templates?name=' . urlencode($templateName);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . WHATSAPP_API_TOKEN,
        ],
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

    if ($httpCode >= 200 && $httpCode < 300) {
        $templates = $data['data'] ?? [];
        return [
            'ok'   => true,
            'data' => $templates[0] ?? null,
        ];
    }

    $errorMsg = $data['error']['message'] ?? 'Erreur inconnue';
    return ['ok' => false, 'error' => $errorMsg];
}

/**
 * Envoie un message template WhatsApp (confirmations, notifications, etc.).
 *
 * @param string $to           Numéro de destination (avec +)
 * @param string $templateName Nom du template approuvé
 * @param string $langCode     Code langue (défaut: "fr")
 * @param array  $params       Paramètres du template [{type: "body", parameters: [{type: "text", text: "..."}]}]
 * @return array{ok: bool, error?: string, message_id?: string}
 */
function whatsapp_send_template(string $to, string $templateName, string $langCode = 'fr', array $params = []): array
{
    if (!whatsapp_is_configured()) {
        return ['ok' => false, 'error' => 'WhatsApp API non configurée.'];
    }

    $toClean = preg_replace('/[^0-9]/', '', $to);
    $url = WHATSAPP_API_BASE . '/' . WHATSAPP_PHONE_NUMBER_ID . '/messages';

    // Construire les composants du template
    $components = [];

    // Composant body avec les paramètres
    if (!empty($params)) {
        $bodyParams = [];
        foreach ($params as $value) {
            $bodyParams[] = [
                'type' => 'text',
                'text' => (string)$value,
            ];
        }
        $components[] = [
            'type'       => 'body',
            'parameters' => $bodyParams,
        ];
    }

    $payload = [
        'messaging_product' => 'whatsapp',
        'to'                => $toClean,
        'type'              => 'template',
        'template'          => [
            'name' => $templateName,
            'language' => [
                'code' => $langCode,
            ],
        ],
    ];

    if (!empty($components)) {
        $payload['template']['components'] = $components;
    }

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . WHATSAPP_API_TOKEN,
            'Content-Type: application/json',
        ],
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

    if ($httpCode >= 200 && $httpCode < 300 && isset($data['messages'][0]['id'])) {
        return ['ok' => true, 'message_id' => $data['messages'][0]['id']];
    }

    $errorMsg = $data['error']['message'] ?? 'Erreur inconnue';
    return ['ok' => false, 'error' => $errorMsg];
}

/**
 * Supprime un template WhatsApp.
 *
 * @param string $templateName  Nom du template à supprimer
 * @return array{ok: bool, error?: string}
 */
function whatsapp_delete_template(string $templateName): array
{
    if (!whatsapp_is_configured()) {
        return ['ok' => false, 'error' => 'WhatsApp API non configurée.'];
    }

    $wabaId = WHATSAPP_BUSINESS_ACCOUNT_ID;
    if ($wabaId === '') {
        return ['ok' => false, 'error' => 'WhatsApp Business Account ID non configuré.'];
    }

    $url = WHATSAPP_API_BASE . '/' . $wabaId . '/message_templates?name=' . urlencode($templateName);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_CUSTOMREQUEST  => 'DELETE',
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . WHATSAPP_API_TOKEN,
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 15,
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode >= 200 && $httpCode < 300) {
        return ['ok' => true];
    }

    $data = json_decode($response ?? '{}', true);
    $errorMsg = $data['error']['message'] ?? 'Erreur inconnue';
    return ['ok' => false, 'error' => $errorMsg];
}
