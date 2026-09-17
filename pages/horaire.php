<?php
require_once __DIR__ . '/../functions/classes.php';
require_once __DIR__ . '/../functions/cours.php';
require_once __DIR__ . '/../functions/creneaux.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add') {
    addCreneau(
        $_POST['classe_id'],
        $_POST['cours_id'],
        $_POST['jour'],
        $_POST['heure_debut'],
        $_POST['heure_fin'],
        $_POST['salle']
    );
    $message = "Créneau ajouté.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    deleteCreneau($_POST['id']);
    $message = "Créneau supprimé.";
}

$classes = getAllClasses();
$coursList = getAllCours();
$creneaux = getAllCreneaux();
$jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'];
require_once __DIR__ . '/../includes/header.php';
?>

<h2>Gestion des horaires</h2>
<?php if ($message): ?>
    <div class="msg"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="card">
    <h3>Ajouter un créneau</h3>
    <form method="post">
        <input type="hidden" name="action" value="add">
        <div class="form-row">
            <div class="form-group">
                <label>Classe</label>
                <select name="classe_id">
                    <?php foreach ($classes as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Cours</label>
                <select name="cours_id">
                    <?php foreach ($coursList as $co): ?>
                        <option value="<?= $co['id'] ?>"><?= htmlspecialchars($co['code']) ?> - <?= htmlspecialchars($co['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Jour</label>
                <select name="jour">
                    <?php foreach ($jours as $j): ?>
                        <option value="<?= $j ?>"><?= ucfirst($j) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Début</label>
                <input type="time" name="heure_debut">
            </div>
            <div class="form-group">
                <label>Fin</label>
                <input type="time" name="heure_fin">
            </div>
            <div class="form-group">
                <label>Salle</label>
                <input type="text" name="salle" placeholder="R104">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </form>
</div>

<h3>Horaires enregistrés</h3>
<div class="table-responsive">
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
                <td><?= htmlspecialchars($cr['classe_nom']) ?></td>
                <td><?= htmlspecialchars($cr['code_cours']) ?></td>
                <td><?= ucfirst($cr['jour']) ?></td>
                <td><?= substr($cr['heure_debut'], 0, 5) ?></td>
                <td><?= substr($cr['heure_fin'], 0, 5) ?></td>
                <td><?= htmlspecialchars($cr['salle']) ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $cr['id'] ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>