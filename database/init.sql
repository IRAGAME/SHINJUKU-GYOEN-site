-- ============================================================
--  SHINJUKU GYOEN - Schéma de la base de données
--  Projet PHP + MySQL (étudiant)
-- ============================================================
--  Tables : users, site_settings, reservations, comments
--  Contient le schéma ET les données de démonstration.
--  Exécuter ce fichier via le script install.php ou la CLI :
--      mariadb -u root < database/init.sql
-- ============================================================

CREATE DATABASE IF NOT EXISTS shinjuku_gyoen
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE shinjuku_gyoen;

-- ------------------------------------------------------------
-- Utilisateurs
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id            INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    username      VARCHAR(60)      NOT NULL,
    email         VARCHAR(190)     NOT NULL,
    password_hash VARCHAR(255)     NOT NULL,
    full_name     VARCHAR(120)     NULL DEFAULT NULL,
    role          ENUM('user','admin') NOT NULL DEFAULT 'user',
    created_at    TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_users_username (username),
    UNIQUE KEY uq_users_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Paramètres du site (le jardin)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS site_settings (
    setting_key   VARCHAR(60)  NOT NULL,
    setting_value TEXT         NULL,
    PRIMARY KEY (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Réservations
--   - Un utilisateur réserve un créneau (date + heure).
--   - La capacité par créneau est vérifiée côté application
--     à l'aide du paramètre 'capacity_per_slot'.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS reservations (
    id         INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    user_id    INT UNSIGNED  NOT NULL,
    visit_date DATE          NOT NULL,
    visit_time TIME          NOT NULL,
    visitors   INT UNSIGNED  NOT NULL DEFAULT 1,
    status     ENUM('pending','confirmed','cancelled') NOT NULL DEFAULT 'confirmed',
    created_at TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_reservations_user (user_id),
    KEY idx_reservations_slot (visit_date, visit_time),
    CONSTRAINT fk_reservations_user
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Avis / commentaires
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS comments (
    id         INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    user_id    INT UNSIGNED     NOT NULL,
    rating     TINYINT UNSIGNED NOT NULL,
    content    TEXT             NOT NULL,
    created_at TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_comments_user (user_id),
    KEY idx_comments_created (created_at),
    CONSTRAINT fk_comments_user
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT chk_comments_rating CHECK (rating BETWEEN 1 AND 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- ============================================================
--  SHINJUKU GYOEN - Données initiales
--  (à exécuter après schema.sql)
-- ============================================================

USE shinjuku_gyoen;

-- ------------------------------------------------------------
-- Paramètres du jardin
-- ------------------------------------------------------------
INSERT INTO site_settings (setting_key, setting_value) VALUES
    ('site_name',              'Shinjuku Gyoen'),
    ('tagline',                'Le jardin impérial au cœur de Tokyo'),
    ('description',            'Shinjuku Gyoen est l''un des plus grands et des plus beaux jardins de Tokyo. Entre jardin japonais, jardin anglais et jardin français, il offre un havre de paix de 58 hectares au milieu de la ville.'),
    ('address',                '11 Naitomachi, Shinjuku City, Tokyo 160-0014, Japon'),
    ('opening_hour',           '09:00'),
    ('closing_hour',           '18:00'),
    ('ticket_price',           '500'),
    ('capacity_per_slot',      '100'),
    ('max_visitors_per_reservation', '10'),
    ('season',                 'Printemps'),
    ('features',               'Jardin japonais, jardin français, jardin anglais, serre, maison de thé, cerisiers en fleurs'),
    ('contact_phone',          '+81 3-3350-0151'),
    ('contact_email',          'contact@shinjukugyoen.example.jp');

-- ------------------------------------------------------------
-- Un compte administrateur de démonstration
--   identifiant : admin   mot de passe : admin123
-- ------------------------------------------------------------
INSERT INTO users (username, email, password_hash, full_name, role)
VALUES (
    'admin',
    'admin@shinjukugyoen.example.jp',
    '$2y$12$2hkQTPf4OQLm0oCapWjLj.O6ozbHYroeFdWeg9D7dFYARlc47oWT.', -- admin123
    'Administrateur du site',
    'admin'
);

-- ------------------------------------------------------------
-- Quelques avis de visiteurs (démo)
--   (TRUNCATE => le script reste ré-exécutable sans doublons)
-- ------------------------------------------------------------
TRUNCATE TABLE comments;
TRUNCATE TABLE reservations;

INSERT INTO users (username, email, password_hash, full_name, role) VALUES
    ('hana',   'hana@example.jp',   '$2y$12$y2a8nYy.tN4fA3wnhjn6P.GYPSOyFfurkJewiwep/Mdhoq3p.w2j.', 'Hana Tanaka', 'user'),
    ('yuki',   'yuki@example.jp',   '$2y$12$XBTQQHXNKcG4K07SBKa1SeHpmZmwFM/vFp32r44aP45hTT2dQZ6TW', 'Yuki Sato',   'user'),
    ('emma',   'emma@example.jp',   '$2y$12$/i7FCm8RI/y1340AABeQwuiJpZ3BJW5ltwxNzx/YYVYoyE7lkzNEC', 'Emma Dubois', 'user');

INSERT INTO comments (user_id, rating, content) VALUES
    (2, 5, 'Le jardin est absolument magnifique, surtout pendant la floraison des cerisiers. Un vrai havre de paix en plein Tokyo !'),
    (3, 4, 'Très beau parc, les jardins japonais sont superbes. Prévoyez de la marge pour l''entrée le week-end.'),
    (4, 5, 'Endroit magique pour se promener. Le jardin français et la serre valent vraiment le détour.'),
    (2, 4, 'J''y suis retourné en automne, les couleurs des érables sont à couper le souffle.'),
    (4, 5, 'L''organisation de la réservation en ligne est simple et rapide. Je recommande vivement !');

-- ------------------------------------------------------------
-- Quelques réservations (démo)
-- ------------------------------------------------------------
INSERT INTO reservations (user_id, visit_date, visit_time, visitors, status) VALUES
    (2, DATE_ADD(CURDATE(), INTERVAL 3 DAY), '10:00:00', 2, 'confirmed'),
    (3, DATE_ADD(CURDATE(), INTERVAL 5 DAY), '14:30:00', 4, 'confirmed'),
    (4, DATE_ADD(CURDATE(), INTERVAL 7 DAY), '09:30:00', 1, 'confirmed');
