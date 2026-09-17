<?php
require_once __DIR__ . '/../functions/classes.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add') {
    addClasse($_POST['nom'], $_POST['annee_scolaire']);
    $message = "Classe ajoutée.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    deleteClasse($_POST['id']);
    $message = "Classe supprimée.";
}

$classes = getAllClasses();
require_once __DIR__ . '/../includes/header.php';
?>

<h2>Gestion des classes</h2>
<?php if ($message): ?>
    <div class="msg"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="card">
    <h3>Ajouter une classe</h3>
    <form method="post">
        <input type="hidden" name="action" value="add">
        <div class="form-row">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" placeholder="I.DA-P3A">
            </div>
            <div class="form-group">
                <label>Année scolaire</label>
                <input type="text" name="annee_scolaire" placeholder="2026-2027">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </form>
</div>

<h3>Liste des classes</h3>
<div class="table-responsive">
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
                <td><?= htmlspecialchars($c['nom']) ?></td>
                <td><?= htmlspecialchars($c['annee_scolaire']) ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $c['id'] ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>