<?php

require_once __DIR__ . '/../config/database.php';

$projectRoot = realpath(__DIR__ . '/..');
$pageDir = dirname($_SERVER['SCRIPT_FILENAME']);
$prefix = '';
while (realpath($pageDir) !== $projectRoot) {
    $prefix .= '../';
    $pageDir = dirname($pageDir);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Horaire Élèves - CFPT</title>
    <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
</head>

<body>
    <nav>
        <a href="<?= $prefix ?>index.php">Accueil</a>
        <a href="<?= $prefix ?>pages/classes.php">Classes</a>
        <a href="<?= $prefix ?>pages/cours.php">Cours</a>
        <a href="<?= $prefix ?>pages/horaire.php">Horaires</a>
    </nav>
    <main class="container">