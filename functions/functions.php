<?php
require_once __DIR__ . '/../connexion/db.php';


// Classes
function getAllClasses() {
    $pdo = getDb();
    $stmt = $pdo->query("SELECT * FROM classes ORDER BY nom");
    return $stmt->fetchAll();
}
function getClassesId($id){
    $pdo = getDb();
    $stmt = $pdo->prepare("SELECT * FROM classes WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}
function getClassesName($name){
    $pdo = getDb();
    $stmt = $pdo->prepare("SELECT * FROM classes WHERE nom = ?");
    $stmt->execute([$name]);
    return $stmt->fetchAll();
}
function addClasse($name, $schoolYear){
    $pdo = getDb();
    $stmt = $pdo->prepare("INSERT INTO classes VALUE(nom, annee_scolaire) ");
    return $stmt->execute([$name, $schoolYear]);
}
function updateClasse($name, $schoolYear){
    $pdo = getDb();
    $stmt = $pdo->prepare("UPDATE classes SET nom = ?, annee_scolaire = ? WHERE id = ? ");
    return $stmt->execute([$name, $schoolYear]);
}
function deleteClasse($id){
    $pdo = getDb();
    $stmt = $pdo->prepare("DELETE FROM classes WHERE id = ?");
    return $stmt->execute([$id]);
}

// Creneaux 
function getAllCreneaux() {
    $pdo = getDb();
    $sql = "SELECT *
            c.id AS classe_id, c.nom AS classe_nom, c.annee_scolaire,
            co.id AS cours_id, co.code AS code_cours, co.nom AS cours_nom
            FROM creneaux cr
            JOIN classes c ON cr.classe_id = c.id
            JOIN cours co ON cr.cours_id = co.id
            ORDER BY c.nom, FIELD(cr.jour,'lundi','mardi','mercredi','jeudi','vendredi'), cr.heure_debut";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}
function getCreneauxById($id){
    $pdo = getDb();
    $stmt = "SELECT *
            c.id AS classe_id, c.nom AS classe_nom, c.annee_scolaire,
            co.id AS cours_id, co.code AS code_cours, co.nom AS cours_nom
            FROM creneaux cr
            JOIN classes c ON cr.classe_id = c.id
            JOIN cours co ON cr.cours_id = co.id
            WHERE cr.id = ? ";
    $stmt = $pdo->query($id);
    return $stmt->fetchAll();
}

function getCreneauxName($name){
    $pdo = getDb();
    $stmt = "SELECT *
            c.id AS classe_id, c.nom AS classe_nom, c.annee_scolaire,
            co.id AS cours_id, co.code AS code_cours, co.nom AS cours_nom
            FROM creneaux cr
            JOIN classes c ON cr.classe_id = c.id
            JOIN cours co ON cr.cours_id = co.id
            WHERE cr.nom = ? ";
    $stmt = $pdo->query($name);
    return $stmt->fetchAll();
}
function addCreneaux($jour, $classe_id, $cours_id, $heure_debut, $heure_fin, $salle){
    $pdo = getDb();
    $stmt = $pdo->prepare("INSERT INTO creneaux VALUE (classe_id, cours_id, jour, heure_debut, heure_fin, salle) ");
    return $stmt->execute([$jour, $classe_id, $cours_id, $heure_debut, $heure_fin, $salle]);
}
function updateCreneaux($jour, $classe_id, $cours_id, $heure_debut, $heure_fin, $salle){
    $pdo = getDb();
    $stmt = $pdo->prepare("UPDATE creneaux SET classe_id = ?, cours_id = ?, jour = ?, heure_debut = ?, heure_fin = ?, salle = ? WHERE id = ? ");
    return $stmt->execute([$jour, $classe_id, $cours_id, $heure_debut, $heure_fin, $salle]);
}
function deleteCreneaux($id){
    $pdo = getDb();
    $stmt = $pdo->prepare("DELETE FROM creneaux WHERE id = ?");
    return $stmt->execute([$id]);
}


//Cours
function getAllCours() {
    $pdo = getDb();
    $stmt = $pdo->query("SELECT * FROM cours ORDER BY nom");
    return $stmt->fetchAll();
}
function getCoursId($id){
    $pdo = getDb();
    $stmt = $pdo->prepare("SELECT * FROM cours WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}
function getCoursName($name){
    $pdo = getDb();
    $stmt = $pdo->prepare("SELECT * FROM cours WHERE nom = ?");
    $stmt->execute([$name]);
    return $stmt->fetchAll();
}
function addCours($name, $code){
    $pdo = getDb();
    $stmt = $pdo->prepare("INSERT INTO cours VALUE(nom, code) ");
    return $stmt->execute([$name, $code]);
}
function updateCours($name, $code){
    $pdo = getDb();
    $stmt = $pdo->prepare("UPDATE cours SET nom = ?, code = ? WHERE id = ? ");
    return $stmt->execute([$name, $code ]);
}
function deleteCours($id){
    $pdo = getDb();
    $stmt = $pdo->prepare("DELETE FROM cours WHERE id = ?");
    return $stmt->execute([$id]);
}