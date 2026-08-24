<?php

declare(strict_types=1);

/**
 * ============================================================
 *  SHINJUKU GYOEN - Installeur de la base de données
 * ============================================================
 *  - Lit database/init.sql (schéma + données de démo)
 *  - L'exécute sur la base de données de l'application
 *
 *  Usage :
 *    - Web  : ouvrir /EXAMEN/database/install.php
 *    - CLI  : php database/install.php
 *
 *  Si la base ou l'utilisateur n'existent pas encore, exécuter
 *  en tant que root :
 *      mariadb -u root < database/init.sql
 *      GRANT ALL ON shinjuku_gyoen.* TO 'gyoen_app'@'localhost';
 * ============================================================
 */

header('Content-Type: text/plain; charset=utf-8');

require __DIR__ . '/../config/db.php';

$sqlFile = __DIR__ . '/init.sql';

if (!is_file($sqlFile)) {
    die("Fichier init.sql introuvable : $sqlFile\n");
}

/* 1) Connexion d'essai : si elle échoue, on guide l'utilisateur. */
try {
    getPDO();
    echo "Connexion à la base '".DB_NAME."' : OK\n";
} catch (RuntimeException $e) {
    echo "Connexion impossible : ".$e->getMessage()."\n\n";
    echo "Vérifiez que la base et l'utilisateur existent, puis réessayez :\n\n";
    echo "  sudo mariadb <<'SQL'\n";
    echo "  CREATE DATABASE IF NOT EXISTS ".DB_NAME." CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;\n";
    echo "  CREATE USER IF NOT EXISTS '".DB_USER."'@'localhost' IDENTIFIED BY '".DB_PASS."';\n";
    echo "  CREATE USER IF NOT EXISTS '".DB_USER."'@'127.0.0.1' IDENTIFIED BY '".DB_PASS."';\n";
    echo "  GRANT ALL PRIVILEGES ON ".DB_NAME.".* TO '".DB_USER."'@'localhost';\n";
    echo "  GRANT ALL PRIVILEGES ON ".DB_NAME.".* TO '".DB_USER."'@'127.0.0.1';\n";
    echo "  FLUSH PRIVILEGES;\n";
    echo "  SQL\n";
    exit(1);
}

/* 2) Exécution du script init.sql, instruction par instruction. */
$sql = file_get_contents($sqlFile);
$pdo = getPDO();

// Supprime les commentaires SQL pour éviter les faux points-virgules.
$sql = preg_replace('/^\s*--.*$/m', '', $sql);

$ok    = 0;
$error = 0;
foreach (preg_split('/;\s*(?:\n|$)/', $sql) as $statement) {
    $statement = trim($statement);
    if ($statement === '') {
        continue;
    }
    try {
        $pdo->exec($statement);
        $ok++;
    } catch (PDOException $e) {
        $error++;
        echo "  [!] ".$e->getMessage()."\n";
    }
}

echo "Instructions exécutées avec succès : $ok\n";
echo "Instructions en erreur (souvent 'existe déjà') : $error\n";
echo "Installation terminée.\n";
