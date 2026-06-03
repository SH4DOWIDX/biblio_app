-- Création de la base de données
CREATE DATABASE coursBiblio_db;
USE coursBiblio_db;
-- Table categories (inchangée)
CREATE TABLE categories(
    id int primary key auto_increment,
    nom varchar(100) not null
);
-- Table adherents (inchangée)
CREATE TABLE adherents(
    id int primary key auto_increment,
    nom varchar(30),
    adresse varchar(20),
    tel varchar(15),
    email varchar(100) not null,
    date_insc date
);
-- Table livres (avec ON DELETE CASCADE)
CREATE TABLE livres(
    id int primary key auto_increment,
    titre varchar(50) not null,
    auteur varchar(20) not null,
    annee_publication int not null,
    nombre_exemplaire int not null,
    categorie_id int not null,
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE CASCADE
);
-- Table emprunts (avec ON DELETE CASCADE)
CREATE TABLE emprunts(
    livre_id int,
    adherent_id int,
    primary key (livre_id, adherent_id),
    date_emprunt date not null,
    statut varchar(20) not null,
    FOREIGN KEY (livre_id) REFERENCES livres(id) ON DELETE CASCADE,
    FOREIGN KEY (adherent_id) REFERENCES adherents(id) ON DELETE CASCADE
);
-- Données de test
INSERT INTO categories (nom)
VALUES ('Roman'),
    ('Science-Fiction'),
    ('Histoire'),
    ('Informatique'),
    ('BD');
INSERT INTO adherents (nom, adresse, tel, email, date_insc)
VALUES (
        'Idrissa Maïga',
        'Kati',
        '83626342',
        'idi@email.com',
        '2025-01-15'
    ),
    (
        'Alhousseyni Maïga',
        'Kati',
        '75000075',
        'alphou@email.com',
        '2025-02-20'
    ),
    (
        'Saran Keïta',
        'Bamako',
        '75757575',
        'saran@email.com',
        '2026-02-20'
    ),
    (
        'Djodo Macalou',
        'Bamako coura',
        '78151524',
        'djodo@email.com',
        '2026-03-10'
    );
INSERT INTO livres (
        titre,
        auteur,
        annee_publication,
        nombre_exemplaire,
        categorie_id
    )
VALUES ('Le Petit Prince', 'Saint-Exupéry', 1943, 5, 1),
    ('1984', 'George Orwell', 1949, 3, 2),
    (
        'Histoire de France',
        'Jules Michelet',
        1855,
        2,
        3
    ),
    ('PHP pour les nuls', 'John Doe', 2020, 4, 4),
    ('Astérix', 'René Goscinny', 1959, 6, 5);
INSERT INTO emprunts (livre_id, adherent_id, date_emprunt, statut)
VALUES (1, 1, '2025-05-01', 'en cours'),
    (2, 2, '2025-05-09', 'en cours'),
    (4, 4, '2025-05-10', 'en cours'),
    (3, 3, '2024-04-15', 'retourné');