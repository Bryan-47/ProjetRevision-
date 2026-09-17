<?php
require_once __DIR__ . '/../connexion/db.php';
require_once __DIR__ . '/../functions/classes.php';
require_once __DIR__ . '/../functions/cours.php';
require_once __DIR__ . '/../functions/creneaux.php';

header('Content-Type: application/json');

$pdo = getDb();
$method = $_SERVER['REQUEST_METHOD'];
$path = trim($_GET['resource'] ?? '', '/');
$segments = array_values(array_filter(explode('/', $path)));
$resource = $segments[0] ?? '';
$id = isset($segments[1]) ? (int)$segments[1] : (isset($_GET['id']) ? (int)$_GET['id'] : null);

function jsonResponse($data, $code = 200) {
    http_response_code($code);
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

function bodyParams() {
    $body = json_decode(file_get_contents('php://input'), true);
    return $body ?: $_POST;
}

if ($resource === 'cours' && $method === 'GET' && isset($_GET['classe'])) {
    $classe = getClasseByNom($_GET['classe']);
    if (!$classe) {
        jsonResponse(['error' => 'Classe inconnue'], 404);
    }
    $horaires = [];
    foreach (getCreneauxByClasseNom($classe['nom']) as $cr) {
        $horaires[] = [
            'jour' => $cr['jour'],
            'heure_debut' => substr($cr['heure_debut'], 0, 5),
            'heure_fin' => substr($cr['heure_fin'], 0, 5),
            'cours' => $cr['cours_nom'],
            'code_cours' => $cr['code_cours'],
            'salle' => $cr['salle']
        ];
    }
    jsonResponse([
        'classe' => $classe['nom'],
        'annee_scolaire' => $classe['annee_scolaire'],
        'horaires' => $horaires
    ]);
}

switch ($resource) {
    case 'classes':
        switch ($method) {
            case 'GET':
                if ($id) {
                    $classe = getClasseById($id);
                    if (!$classe) jsonResponse(['error' => 'Classe introuvable'], 404);
                    jsonResponse($classe);
                }
                jsonResponse(getAllClasses());
            case 'POST':
                $params = bodyParams();
                if (empty($params['nom']) || empty($params['annee_scolaire'])) {
                    jsonResponse(['error' => 'nom et annee_scolaire requis'], 400);
                }
                jsonResponse([
                    'id' => addClasse($params['nom'], $params['annee_scolaire'])
                ], 201);
            case 'PUT':
                $params = bodyParams();
                if ($id && $params) {
                    updateClasse($id, $params['nom'], $params['annee_scolaire']);
                    jsonResponse(['message' => 'Classe modifiée']);
                }
                jsonResponse(['error' => 'id, nom et annee_scolaire requis'], 400);
            case 'DELETE':
                if ($id) {
                    if (deleteClasse($id)) {
                        jsonResponse(['message' => 'Classe supprimée'], 204);
                    }
                }
                jsonResponse(['error' => 'id requis'], 400);
        }
        break;

    case 'cours':
        switch ($method) {
            case 'GET':
                if ($id) {
                    $cours = getCoursById($id);
                    if (!$cours) jsonResponse(['error' => 'Cours introuvable'], 404);
                    jsonResponse($cours);
                }
                jsonResponse(getAllCours());
            case 'POST':
                $params = bodyParams();
                if (empty($params['code']) || empty($params['nom'])) {
                    jsonResponse(['error' => 'code et nom requis'], 400);
                }
                jsonResponse([
                    'id' => addCours($params['code'], $params['nom'])
                ], 201);
            case 'PUT':
                $params = bodyParams();
                if ($id && $params) {
                    updateCours($id, $params['code'], $params['nom']);
                    jsonResponse(['message' => 'Cours modifié']);
                }
                jsonResponse(['error' => 'id, code et nom requis'], 400);
            case 'DELETE':
                if ($id) {
                    if (deleteCours($id)) {
                        jsonResponse(['message' => 'Cours supprimé'], 204);
                    }
                }
                jsonResponse(['error' => 'id requis'], 400);
        }
        break;

    case 'creneaux':
        switch ($method) {
            case 'GET':
                if ($id) {
                    $creneau = getCreneauById($id);
                    if (!$creneau) jsonResponse(['error' => 'Créneau introuvable'], 404);
                    jsonResponse($creneau);
                }
                jsonResponse(getAllCreneaux());
            case 'POST':
                $params = bodyParams();
                if (empty($params['classe_id']) || empty($params['cours_id']) || empty($params['jour'])
                    || empty($params['heure_debut']) || empty($params['heure_fin']) || empty($params['salle'])) {
                    jsonResponse(['error' => 'classe_id, cours_id, jour, heure_debut, heure_fin, salle requis'], 400);
                }
                jsonResponse([
                    'id' => addCreneau($params['classe_id'], $params['cours_id'], $params['jour'],
                        $params['heure_debut'], $params['heure_fin'], $params['salle'])
                ], 201);
            case 'PUT':
                $params = bodyParams();
                if ($id && $params) {
                    updateCreneau($id, $params['classe_id'], $params['cours_id'], $params['jour'],
                        $params['heure_debut'], $params['heure_fin'], $params['salle']);
                    jsonResponse(['message' => 'Créneau modifié']);
                }
                jsonResponse(['error' => 'id et tous les champs requis'], 400);
            case 'DELETE':
                if ($id) {
                    if (deleteCreneau($id)) {
                        jsonResponse(['message' => 'Créneau supprimé'], 204);
                    }
                }
                jsonResponse(['error' => 'id requis'], 400);
        }
        break;

    default:
        jsonResponse([
            'error' => 'Ressource inconnue',
            'disponible' => ['/api/classes', '/api/cours', '/api/creneaux', '/api/cours?classe=NOM']
        ], 404);
}

jsonResponse(['error' => 'non autorized method'], 405);