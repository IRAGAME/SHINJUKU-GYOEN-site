<?php

/**
 * ============================================================
 *  Configuration de la base de données (PDO)
 *  Projet : Shinjuku Gyoen
 * ============================================================
 *  Sur Render : utilise DATABASE_URL (PostgreSQL automatique)
 *  En local   : utilise les constantes ci-dessous (MySQL)
 * ============================================================
 */

function getPDO(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    // Supabase pooler (IPv4, fonctionne depuis Render)
    $poolerUrl = 'postgresql://postgres.bbpktvbvvnnelkewchal:sinjuku%402026@aws-1-eu-west-1.pooler.supabase.com:5432/postgres';

    // Priorité : DATABASE_URL env, mais on remplace l'host direct par le pooler
    $databaseUrl = getenv('DATABASE_URL') ?: $poolerUrl;

    // Si l'URL contient le host direct Supabase, remplacer par le pooler
    if (strpos($databaseUrl, 'db.bbpktvbvvnnelkewchal.supabase.co') !== false) {
        $databaseUrl = $poolerUrl;
    }

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
        $host   = $parts['host']     ?? '127.0.0.1';
        $port   = $parts['port']     ?? '5432';
        $dbName = ltrim($parts['path'] ?? '', '/');
        $user   = $parts['user']     ?? '';
        $pass   = $parts['password'] ?? '';
        $dsn = "pgsql:host={$host};port={$port};dbname={$dbName}";
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
