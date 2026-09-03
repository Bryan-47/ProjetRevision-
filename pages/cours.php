<?php
require_once __DIR__ . '/../functions/cours.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'add') {
    addCours($_POST['code'], $_POST['nom']);
    $message = "Cours ajout.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
    deleteCours($_POST['id']);
    $message = "cours supprime.";
}

$coursList = getAllCours();
$pageTitle = "Cours";
require_once __DIR__ . '/../includes/header.php';

?>

<h2>Gestion des cours</h2>
<?php if ($message): ?>
    <div class="msg"><?= $message ?></div><?php endif; ?>

<div class="form-box">
    <h3>Ajouter un cours</h3>
    <form method="post">
        <input type="hidden" name="action" value="add">

        <label>Code</label>
        <input type="text" name="code">

        <label>Nom</label>
        <input type="text" name="nom">

        <button type="submit">Ajouter</button>
    </form>
</div>

<h3>Liste des cours</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Code</th>
        <th>Nom</th>
        <th></th>
    </tr>
    <?php foreach ($coursList as $co): ?>
        <tr>
            <td><?= $co['id'] ?></td>
            <td><?= $co['code'] ?></td>
            <td><?= $co['nom'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $co['id'] ?>">
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>