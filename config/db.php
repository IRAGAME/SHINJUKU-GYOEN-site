<?php

/**
 * ============================================================
 *  Configuration de la base de données (PDO)
 *  Projet : Shinjuku Gyoen
 * ============================================================
 *  Sur Render : Supabase pooler (IPv4, port 5432)
 *  En local   : MySQL
 * ============================================================
 */

function getPDO(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    // Supabase pooler (IPv4 — fonctionne depuis Render)
    $poolerHost = 'aws-1-eu-west-1.pooler.supabase.com';
    $poolerPort = '5432';
    $poolerDb   = 'postgres';
    $poolerUser = 'postgres.bbpktvbvvnnelkewchal';
    $poolerPass = 'sinjuku@2026';

    // Si DATABASE_URL est défini et pointe ailleurs, l'utiliser
    $databaseUrl = getenv('DATABASE_URL') ?: '';

    if ($databaseUrl !== '' && strpos($databaseUrl, 'db.bbpktvbvvnnelkewchal.supabase.co') === false) {
        // Autre base (ex: MySQL local)
        $parts  = parse_url($databaseUrl);
        $scheme = $parts['scheme'] ?? 'pgsql';

        if ($scheme === 'mysql') {
            $host    = $parts['host'] ?? '127.0.0.1';
            $dbName  = ltrim($parts['path'] ?? '', '/');
            $user    = $parts['user'] ?? '';
            $pass    = $parts['password'] ?? '';
            $charset = 'utf8mb4';
            $dsn = "mysql:host={$host};dbname={$dbName};charset={$charset}";
        } else {
            $host   = $parts['host'] ?? '127.0.0.1';
            $port   = $parts['port'] ?? '5432';
            $dbName = ltrim($parts['path'] ?? '', '/');
            $user   = $parts['user'] ?? '';
            $pass   = $parts['password'] ?? '';
            $dsn = "pgsql:host={$host};port={$port};dbname={$dbName}";
        }
    } else {
        // Par défaut : Supabase pooler IPv4
        $dsn  = "pgsql:host={$poolerHost};port={$poolerPort};dbname={$poolerDb}";
        $user = $poolerUser;
        $pass = $poolerPass;
    }

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (PDOException $e) {
        throw new RuntimeException(
            'Connexion à la base de données impossible : ' . $e->getMessage()
        );
    }

    return $pdo;
}
