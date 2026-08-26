-- ============================================================
--  SHINJUKU GYOEN - Schéma PostgreSQL (Render)
-- ============================================================

-- Utilisateurs
CREATE TABLE IF NOT EXISTS users (
    id            SERIAL PRIMARY KEY,
    username      VARCHAR(60)      NOT NULL,
    email         VARCHAR(190)     NOT NULL,
    password_hash VARCHAR(255)     NOT NULL,
    full_name     VARCHAR(120)     NULL DEFAULT NULL,
    role          VARCHAR(10)      NOT NULL DEFAULT 'user' CHECK (role IN ('user','admin')),
    created_at    TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (username),
    UNIQUE (email)
);

-- Paramètres du site
CREATE TABLE IF NOT EXISTS site_settings (
    setting_key   VARCHAR(60)  PRIMARY KEY,
    setting_value TEXT         NULL
);

-- Réservations
CREATE TABLE IF NOT EXISTS reservations (
    id         SERIAL PRIMARY KEY,
    user_id    INT          NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    visit_date DATE         NOT NULL,
    visit_time TIME         NOT NULL,
    visitors   INT          NOT NULL DEFAULT 1,
    status     VARCHAR(20)  NOT NULL DEFAULT 'confirmed' CHECK (status IN ('pending','confirmed','cancelled')),
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX IF NOT EXISTS idx_reservations_user ON reservations(user_id);
CREATE INDEX IF NOT EXISTS idx_reservations_slot ON reservations(visit_date, visit_time);

-- Avis / commentaires
CREATE TABLE IF NOT EXISTS comments (
    id         SERIAL PRIMARY KEY,
    user_id    INT          NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    rating     SMALLINT     NOT NULL CHECK (rating BETWEEN 1 AND 5),
    content    TEXT         NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX IF NOT EXISTS idx_comments_user ON comments(user_id);
CREATE INDEX IF NOT EXISTS idx_comments_created ON comments(created_at);

-- Conversations (messagerie)
CREATE TABLE IF NOT EXISTS conversations (
    id               SERIAL PRIMARY KEY,
    visitor_name     VARCHAR(120)     NOT NULL,
    visitor_phone    VARCHAR(20)      NULL DEFAULT NULL,
    visitor_email    VARCHAR(190)     NULL DEFAULT NULL,
    status           VARCHAR(10)      NOT NULL DEFAULT 'open' CHECK (status IN ('open','closed')),
    whatsapp_chat_id VARCHAR(100)     NULL DEFAULT NULL,
    created_at       TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at       TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX IF NOT EXISTS idx_conv_status ON conversations(status);
CREATE INDEX IF NOT EXISTS idx_conv_created ON conversations(created_at);

-- Messages
CREATE TABLE IF NOT EXISTS messages (
    id                    SERIAL PRIMARY KEY,
    conversation_id       INT          NOT NULL REFERENCES conversations(id) ON DELETE CASCADE,
    sender                VARCHAR(10)  NOT NULL CHECK (sender IN ('visitor','admin')),
    body                  TEXT         NOT NULL,
    whatsapp_message_id   VARCHAR(100) NULL DEFAULT NULL,
    created_at            TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX IF NOT EXISTS idx_msg_conv ON messages(conversation_id);
CREATE INDEX IF NOT EXISTS idx_msg_created ON messages(created_at);

-- Données initiales
INSERT INTO site_settings (setting_key, setting_value) VALUES
    ('site_name',              'Shinjuku Gyoen'),
    ('tagline',                'Le jardin impérial au cœur de Tokyo'),
    ('description',            'Shinjuku Gyoen est l''un des plus grands et des plus beaux jardins de Tokyo.'),
    ('address',                '11 Naitomachi, Shinjuku City, Tokyo 160-0014, Japon'),
    ('opening_hour',           '09:00'),
    ('closing_hour',           '18:00'),
    ('ticket_price',           '500'),
    ('capacity_per_slot',      '100'),
    ('max_visitors_per_reservation', '10'),
    ('season',                 'Printemps'),
    ('features',               'Jardin japonais, jardin français, jardin anglais, serre, maison de thé'),
    ('contact_phone',          '+81 3-3350-0151'),
    ('contact_email',          'contact@shinjukugyoen.example.jp')
ON CONFLICT (setting_key) DO NOTHING;

-- Admin (admin / admin123)
INSERT INTO users (username, email, password_hash, full_name, role)
VALUES ('admin', 'admin@shinjukugyoen.example.jp', '$2y$12$2hkQTPf4OQLm0oCapWjLj.O6ozbHYroeFdWeg9D7dFYARlc47oWT.', 'Administrateur du site', 'admin')
ON CONFLICT (username) DO NOTHING;
