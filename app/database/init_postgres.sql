-- --------------------------------------------------
-- init_postgres.sql
-- À monter dans /docker-entrypoint-initdb.d/ du conteneur PostgreSQL
-- --------------------------------------------------

-- (1) Activer l’extension pgcrypto pour pouvoir utiliser digest(...,'sha256')
CREATE EXTENSION IF NOT EXISTS pgcrypto;

-- (2) Création de la table "produits"
CREATE TABLE IF NOT EXISTS produits (
    PRO_id SERIAL PRIMARY KEY,
    PRO_lib VARCHAR(200) NOT NULL,
    PRO_prix NUMERIC(10,2) NOT NULL,
    PRO_description TEXT
);

-- (3) Création de la table "ressources"
CREATE TABLE IF NOT EXISTS ressources (
    RE_id SERIAL PRIMARY KEY,
    RE_type VARCHAR(100) NOT NULL,
    RE_url VARCHAR(1000) NOT NULL,
    RE_nom VARCHAR(100),
    PRO_id INTEGER NOT NULL,
    CONSTRAINT ressources_produits_FK
      FOREIGN KEY (PRO_id)
      REFERENCES produits(PRO_id)
      ON DELETE CASCADE
);

-- (4) Création de la table "utilisateurs"
CREATE TABLE IF NOT EXISTS utilisateurs (
    US_id SERIAL PRIMARY KEY,
    US_login VARCHAR(100) NOT NULL UNIQUE,
    -- On stocke le hash SHA256 en hexadécimal (64 caractères)
    US_password CHAR(64) NOT NULL
);

-- (5) Insérer un utilisateur de test (login "admin", mot de passe "admin123")
INSERT INTO utilisateurs (US_login, US_password)
VALUES (
    'admin',
    'admin123',
)
ON CONFLICT (US_login) DO NOTHING;
