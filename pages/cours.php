<?php
require_once __DIR__ . '/../functions/cours.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add') {
    addCours($_POST['code'], $_POST['nom']);
    $message = "Cours ajouté.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    deleteCours($_POST['id']);
    $message = "Cours supprimé.";
}

$coursList = getAllCours();
require_once __DIR__ . '/../includes/header.php';
?>

<h2>Gestion des cours</h2>
<?php if ($message): ?>
    <div class="msg"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="card">
    <h3>Ajouter un cours</h3>
    <form method="post">
        <input type="hidden" name="action" value="add">
        <div class="form-row">
            <div class="form-group">
                <label>Code</label>
                <input type="text" name="code" placeholder="AWEB3">
            </div>
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" placeholder="Atelier Web">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </form>
</div>

<h3>Liste des cours</h3>
<div class="table-responsive">
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
                <td><?= htmlspecialchars($co['code']) ?></td>
                <td><?= htmlspecialchars($co['nom']) ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $co['id'] ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>