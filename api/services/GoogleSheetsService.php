<?php

declare(strict_types=1);

/**
 * ============================================================
 *  GoogleSheetsService — Envoi de données vers Google Sheets
 *  via Google Apps Script (Web App déployé).
 *  Aucune authentification complexe, juste un POST HTTP.
 * ============================================================
 */

final class GoogleSheetsService
{
    private string $webhookUrl;

    private static ?self $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            $cfg = require __DIR__ . '/../../config/google_sheets.php';
            self::$instance = new self($cfg['webhook_url']);
        }
        return self::$instance;
    }

    private function __construct(string $webhookUrl)
    {
        $this->webhookUrl = $webhookUrl;
    }

    /**
     * Ajoute une ligne dans la feuille Google Sheets.
     *
     * @param array<int, mixed> $values  Valeurs de la ligne
     * @return bool  true si succès
     */
    public function appendRow(array $values): bool
    {
        if ($this->webhookUrl === '' || str_contains($this->webhookUrl, 'VOTRE_URL')) {
            return false;
        }

        try {
            $ch = curl_init($this->webhookUrl);
            curl_setopt_array($ch, [
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => json_encode(['values' => $values], JSON_UNESCAPED_UNICODE),
                CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 15,
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            return $httpCode >= 200 && $httpCode < 300;
        } catch (\Throwable $e) {
            error_log('[GoogleSheets] Erreur : ' . $e->getMessage());
            return false;
        }
    }
}
