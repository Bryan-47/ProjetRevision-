<?php
require_once __DIR__ . '/../connexion/db.php';

function getAllClasses() {
    $pdo = getDb();
    $stmt = $pdo->query("SELECT * FROM classes ORDER BY nom");
    return $stmt->fetchAll();
}

function getClasseById($id) {
    $pdo = getDb();
    $stmt = $pdo->prepare("SELECT * FROM classes WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getClasseByNom($nom) {
    $pdo = getDb();
    $stmt = $pdo->prepare("SELECT * FROM classes WHERE nom = ?");
    $stmt->execute([$nom]);
    return $stmt->fetch();
}

function addClasse($nom, $annee_scolaire) {
    $pdo = getDb();
    $stmt = $pdo->prepare("INSERT INTO classes (nom, annee_scolaire) VALUES (?, ?)");
    $stmt->execute([$nom, $annee_scolaire]);
    return $pdo->lastInsertId();
}

function updateClasse($id, $nom, $annee_scolaire) {
    $pdo = getDb();
    $stmt = $pdo->prepare("UPDATE classes SET nom = ?, annee_scolaire = ? WHERE id = ?");
    return $stmt->execute([$nom, $annee_scolaire, $id]);
}

function deleteClasse($id) {
    $pdo = getDb();
    $stmt = $pdo->prepare("DELETE FROM classes WHERE id = ?");
    return $stmt->execute([$id]);
}
