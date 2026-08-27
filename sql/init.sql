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
    `code` VARCHAR(50) NOT NULL,
    nom VARCHAR(120) NOT NULL
);

CREATE TABLE creneaux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    classe_id INT NOT NULL,
    cours_id INT NOT NULL,
    jour ENUM('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi') NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    salle VARCHAR(20) NOT NULL,
);

ALTER TABLE creneaux
ADD CONSTRAINT fk_creneaux_classe
FOREIGN KEY (classe_id) REFERENCES classes(id);

ALTER TABLE creneaux
ADD CONSTRAINT fk_creneaux_cours
FOREIGN KEY (cours_id) REFERENCES cours(id);