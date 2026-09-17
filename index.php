<?php
require_once __DIR__ . '/functions/classes.php';
require_once __DIR__ . '/functions/cours.php';
require_once __DIR__ . '/functions/creneaux.php';

$classes = getAllClasses();
$coursList = getAllCours();
$creneaux = getAllCreneaux();
require_once __DIR__ . '/includes/header.php';
?>

<h2>Toutes les informations</h2>

<div class="stats">
    <div class="stat-card">
        <span class="stat-number"><?= count($classes) ?></span>
        <span class="stat-label">Classes</span>
    </div>
    <div class="stat-card">
        <span class="stat-number"><?= count($coursList) ?></span>
        <span class="stat-label">Cours</span>
    </div>
    <div class="stat-card">
        <span class="stat-number"><?= count($creneaux) ?></span>
        <span class="stat-label">Créneaux</span>
    </div>
</div>

<h3>Classes</h3>
<div class="table-responsive">
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Année scolaire</th>
            <th>Nombre de cours</th>
        </tr>
        <?php foreach ($classes as $c): ?>
            <?php
            $nb = 0;
            foreach ($creneaux as $cr) {
                if ($cr['classe_id'] == $c['id']) {
                    $nb++;
                }
            }
            ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['nom']) ?></td>
                <td><?= htmlspecialchars($c['annee_scolaire']) ?></td>
                <td><?= $nb ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<h3>Cours</h3>
<div class="table-responsive">
    <table>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Nom</th>
        </tr>
        <?php foreach ($coursList as $co): ?>
            <tr>
                <td><?= $co['id'] ?></td>
                <td><?= htmlspecialchars($co['code']) ?></td>
                <td><?= htmlspecialchars($co['nom']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<h3>Horaires (créneaux)</h3>
<div class="table-responsive">
    <table>
        <tr>
            <th>ID</th>
            <th>Classe</th>
            <th>Cours</th>
            <th>Jour</th>
            <th>Début</th>
            <th>Fin</th>
            <th>Salle</th>
        </tr>
        <?php foreach ($creneaux as $cr): ?>
            <tr>
                <td><?= $cr['id'] ?></td>
                <td><?= htmlspecialchars($cr['classe_nom']) ?> (<?= htmlspecialchars($cr['annee_scolaire']) ?>)</td>
                <td><?= htmlspecialchars($cr['code_cours']) ?> - <?= htmlspecialchars($cr['cours_nom']) ?></td>
                <td><?= ucfirst($cr['jour']) ?></td>
                <td><?= substr($cr['heure_debut'], 0, 5) ?></td>
                <td><?= substr($cr['heure_fin'], 0, 5) ?></td>
                <td><?= htmlspecialchars($cr['salle']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>