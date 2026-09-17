DROP DATABASE IF EXISTS horaires_eleves;

CREATE DATABASE horaires_eleves;

USE horaires_eleves;

CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE,
    annee_scolaire VARCHAR(9) NOT NULL
);

CREATE TABLE cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(20) NOT NULL,
    nom VARCHAR(120) NOT NULL
);

CREATE TABLE creneaux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    classe_id INT NOT NULL,
    cours_id INT NOT NULL,
    jour ENUM('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi') NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    salle VARCHAR(20) NOT NULL
);

ALTER TABLE creneaux
ADD CONSTRAINT fk_creneaux_classe
FOREIGN KEY (classe_id) REFERENCES classes(id);

ALTER TABLE creneaux
ADD CONSTRAINT fk_creneaux_cours
FOREIGN KEY (cours_id) REFERENCES cours(id);

INSERT INTO classes (nom, annee_scolaire) VALUES
('I.DA-P3A', '2026-2027'),
('I.DA-P1A', '2026-2027');

INSERT INTO cours (code, nom) VALUES
('AWEB3', 'Atelier Web 3e année S1'),
('AMAT3', 'Mathématiques 3e année S1'),
('IAMG3', 'Anglais 3e année S1');

INSERT INTO creneaux (classe_id, cours_id, jour, heure_debut, heure_fin, salle) VALUES
(1, 1, 'jeudi', '08:05', '11:40', 'R104'),
(1, 2, 'lundi', '13:00', '15:20', 'R201'),
(2, 1, 'mardi', '08:05', '10:30', 'R104');