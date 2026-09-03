


<?php
require_once __DIR__ . '/../connexion/db.php';

function getAllCours() {
    $pdo = getDb();
    $stmt = $pdo->query("SELECT * FROM cours ORDER BY code");
    return $stmt->fetchAll();
}

function getCoursById($id) {
    $pdo = getDb();
    $stmt = $pdo->prepare("SELECT * FROM cours WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function addCours($code, $nom) {
    $pdo = getDb();
    $stmt = $pdo->prepare("INSERT INTO cours (code, nom) VALUES (?, ?)");
    $stmt->execute([$code, $nom]);
    return $pdo->lastInsertId();
}

function updateCours($id, $code, $nom) {
    $pdo = getDb();
    $stmt = $pdo->prepare("UPDATE cours SET code = ?, nom = ? WHERE id = ?");
    return $stmt->execute([$code, $nom, $id]);
}

function deleteCours($id) {
    $pdo = getDb();
    $stmt = $pdo->prepare("DELETE FROM cours WHERE id = ?");
    return $stmt->execute([$id]);
}
