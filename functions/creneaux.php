<?php
require_once __DIR__ . '/../connexion/db.php';

function getAllCreneaux() {
    $pdo = getDb();
    $sql = "SELECT cr.id, cr.jour, cr.heure_debut, cr.heure_fin, cr.salle,
                   c.id AS classe_id, c.nom AS classe_nom, c.annee_scolaire,
                   co.id AS cours_id, co.code AS code_cours, co.nom AS cours_nom
            FROM creneaux cr
            JOIN classes c ON cr.classe_id = c.id
            JOIN cours co ON cr.cours_id = co.id
            ORDER BY c.nom, FIELD(cr.jour,'lundi','mardi','mercredi','jeudi','vendredi'), cr.heure_debut";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function getCreneauById($id) {
    $pdo = getDb();
    $sql = "SELECT cr.id, cr.jour, cr.heure_debut, cr.heure_fin, cr.salle,
                   c.id AS classe_id, c.nom AS classe_nom, c.annee_scolaire,
                   co.id AS cours_id, co.code AS code_cours, co.nom AS cours_nom
            FROM creneaux cr
            JOIN classes c ON cr.classe_id = c.id
            JOIN cours co ON cr.cours_id = co.id
            WHERE cr.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getCreneauxByClasseNom($nomClasse) {
    $pdo = getDb();
    $sql = "SELECT cr.jour, cr.heure_debut, cr.heure_fin, cr.salle,
                   co.code AS code_cours, co.nom AS cours_nom
            FROM creneaux cr
            JOIN classes c ON cr.classe_id = c.id
            JOIN cours co ON cr.cours_id = co.id
            WHERE c.nom = ?
            ORDER BY FIELD(cr.jour,'lundi','mardi','mercredi','jeudi','vendredi'), cr.heure_debut";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nomClasse]);
    return $stmt->fetchAll();
}

function addCreneau($classe_id, $cours_id, $jour, $heure_debut, $heure_fin, $salle) {
    $pdo = getDb();
    $stmt = $pdo->prepare("INSERT INTO creneaux (classe_id, cours_id, jour, heure_debut, heure_fin, salle) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$classe_id, $cours_id, $jour, $heure_debut, $heure_fin, $salle]);
    return $pdo->lastInsertId();
}

function updateCreneau($id, $classe_id, $cours_id, $jour, $heure_debut, $heure_fin, $salle) {
    $pdo = getDb();
    $stmt = $pdo->prepare("UPDATE creneaux SET classe_id = ?, cours_id = ?, jour = ?, heure_debut = ?, heure_fin = ?, salle = ? WHERE id = ?");
    return $stmt->execute([$classe_id, $cours_id, $jour, $heure_debut, $heure_fin, $salle, $id]);
}

function deleteCreneau($id) {
    $pdo = getDb();
    $stmt = $pdo->prepare("DELETE FROM creneaux WHERE id = ?");
    return $stmt->execute([$id]);
}
