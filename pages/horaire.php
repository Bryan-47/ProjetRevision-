<?php
require_once __DIR__ . '/../functions/classes.php';
require_once __DIR__ . '/../functions/cours.php';
require_once __DIR__ . '/../functions/creneaux.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'add') {
    addCreneau(
        $_POST['classe_id'],
        $_POST['cours_id'],
        $_POST['jour'],
        $_POST['heure_debut'],
        $_POST['heure_fin'],
        $_POST['salle']
    );
    $message = "creneau ajoute.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
    deleteCreneau($_POST['id']);
    $message = "Créneau supprime.";
}

$classes = getAllClasses();
$coursList = getAllCours();
$creneaux = getAllCreneaux();
$jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'];
$pageTitle = "Horaires";


require_once __DIR__ . '/../includes/header.php';

?>

<h2>Gestion des horaires</h2>
<?php if ($message): ?>
    <div>
        <?= $message ?>
    </div>
    <?php endif; ?>

<div>
    <h3>Ajouter un créneau</h3>
    <form method="post">
        <input type="hidden" name="action" value="add">

        <label>Classe</label>
        <select name="classe_id">
            <?php foreach ($classes as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['nom'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Cours</label>
        <select name="cours_id">
            <?php foreach ($coursList as $co): ?>
                <option value="<?= $co['id'] ?>"><?= $co['code'] ?> - <?= $co['nom'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Jour</label>
        <select name="jour">
            <?php foreach ($jours as $j): ?>
                <option value="<?= $j ?>"><?= ucfirst($j) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Heure début</label>
        <input type="time" name="heure_debut">

        <label>Heure fin</label>
        <input type="time" name="heure_fin">

        <label>Salle</label>
        <input type="text" name="salle" placeholder="R104">

        <button type="submit">Ajouter</button>
    </form>
</div>

<h3>Horaires enregistrés</h3>
<table>
    <tr>
        <th>Classe</th>
        <th>Cours</th>
        <th>Jour</th>
        <th>Début</th>
        <th>Fin</th>
        <th>Salle</th>
        <th></th>
    </tr>
    <?php foreach ($creneaux as $cr): ?>
        <tr>
            <td><?= $cr['classe_nom'] ?></td>
            <td><?= $cr['code_cours'] ?></td>
            <td><?= ucfirst($cr['jour']) ?></td>
            <td><?= substr($cr['heure_debut'], 0, 5) ?></td>
            <td><?= substr($cr['heure_fin'], 0, 5) ?></td>
            <td><?= $cr['salle'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $cr['id'] ?>">
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php 

require_once __DIR__ . '/../includes/footer.php';

?>