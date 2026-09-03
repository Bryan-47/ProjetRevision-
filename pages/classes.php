<?php
require_once __DIR__ . '/../functions/classes.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'add') {
    addClasse($_POST['nom'], $_POST['annee_scolaire']);
    $message = "classe ajoute.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
    deleteClasse($_POST['id']);
    $message = "lasse supprime.";
}

$classes = getAllClasses();
$pageTitle = "Classes";
require_once __DIR__ . '/../includes/header.php';
?>

<h2>Gestion des classes</h2>
<?php if ($message): ?>
    <div class="msg"><?= $message ?></div><?php endif; ?>

<div class="form-box">
    <h3>Ajouter une classe</h3>
    <form method="post">
        <input type="hidden" name="action" value="add">

        <label>Nom</label>
        <input type="text" name="nom">

        <label>Année scolair</label>
        <input type="text" name="annee_scolaire" placeholder="2026-2027">

        <button type="submit">Ajouter</button>
    </form>
</div>

<h3>Liste des classes</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Année scolaire</th>
        <th></th>
    </tr>
    <?php foreach ($classes as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= $c['nom'] ?></td>
            <td><?= $c['annee_scolaire'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $c['id'] ?>">
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>