<?php

declare(strict_types=1);

/**
 * ============================================================
 *  SHINJUKU GYOEN - Installeur de la base de données
 * ============================================================
 *  Détecte automatiquement MySQL ou PostgreSQL.
 *  Sur Render : utilise init_pg.sql (PostgreSQL)
 *  En local   : utilise init.sql (MySQL)
 * ============================================================
 */

header('Content-Type: text/plain; charset=utf-8');

require __DIR__ . '/../config/db.php';

$pdo = getPDO();

$driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);

if ($driver === 'pgsql' || $driver === 'postgres') {
    $sqlFile = __DIR__ . '/init_pg.sql';
    echo "Détecté : PostgreSQL\n";
} else {
    $sqlFile = __DIR__ . '/init.sql';
    echo "Détecté : MySQL\n";
}

if (!is_file($sqlFile)) {
    die("Fichier SQL introuvable : $sqlFile\n");
}

echo "Base de données connectée : OK\n\n";

$sql = file_get_contents($sqlFile);

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
        $msg = $e->getMessage();
        if (strpos($msg, 'already exists') !== false || strpos($msg, 'duplicate') !== false) {
            $ok++;
        } else {
            echo "  [!] " . $msg . "\n";
        }
    }
}

echo "Instructions exécutées avec succès : $ok\n";
if ($error > 0) {
    echo "Instructions ignorées (existe déjà) : $error\n";
}
echo "Installation terminée.\n";
