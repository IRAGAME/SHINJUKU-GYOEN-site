<?php

/**
 * ============================================================
 *  Configuration de la base de données (PDO / MySQL)
 *  Projet : Shinjuku Gyoen
 * ============================================================
 *  Ce fichier est le SEUL endroit où les accès BDD sont définis.
 *  Il retourne une connexion PDO unique (singleton) via getPDO().
 * ============================================================
 */

const DB_HOST    = '127.0.0.1';
const DB_NAME    = 'shinjuku_gyoen';
const DB_USER    = 'gyoen_app';
const DB_PASS    = 'Shinju_2026_Gyoen';
const DB_CHARSET = 'utf8mb4';

/**
 * Retourne l'instance PDO (unique) de l'application.
 *
 * @return PDO
 * @throws RuntimeException si la connexion échoue
 */
function getPDO(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
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
