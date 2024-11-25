<?php
declare(strict_types=1);
session_start();

require_once 'flight/Flight.php';
// require 'flight/autoload.php';


Flight::set('pseudo', null);



function renvoieBDD() {
    try {
        $db = new PDO("pgsql:host=localhost;port=5432;dbname=objets", "postgres", "VI22ol14");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur de connexion à la base de données : ' . $e->getMessage());
        exit;
    }
}

Flight::route('/', function() {

    $pseudo = $_SESSION['pseudo'] ?? null;

    $db = renvoieBDD();
    try {
        $sth = $db->prepare("SELECT * FROM score ORDER BY value DESC LIMIT 10");
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        Flight::render('accueil', ['results' => $results, 'pseudo' => $pseudo]); 
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur lors de la récupération des scores : ' . $e->getMessage());
    }
});

Flight::route('POST /api/set_pseudo', function() {
    $pseudo = Flight::request()->data->pseudo;
    if (!empty($pseudo)) {
        $_SESSION['pseudo'] = $pseudo;
        Flight::json(['message' => 'Pseudo enregistré avec succès', 'pseudo' => $_SESSION['pseudo']]);
    } else {
        Flight::halt(400, 'Le pseudo est vide');
    }
    Flight::set('pseudo', $pseudo);
    Flight::redirect('/');
});

Flight::route('POST /api/save_score', function() {
    $pseudo = $_SESSION['pseudo'];
    $data = Flight::request()->data;
    $score_value = $data->score_value;
    $db = renvoieBDD();
    try {
        $sth = $db->prepare("INSERT INTO score (pseudo, value) VALUES (:pseudo, :score_value)");
        $sth->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $sth->bindParam(':score_value', $score_value, PDO::PARAM_INT);
        $sth->execute();

        Flight::json(['message' => 'Score enregistré avec succès', 'pseudo' => $pseudo, 'score' => $score_value]);
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur lors de la sauvegarde du score : ' . $e->getMessage());
    }

});

Flight::route('/carte', function() {
    Flight::render('carte');
});


Flight::route('GET /api/objets', function() {
    $db = renvoieBDD();
    $objets = [];
    try {
        $sth = $db->prepare("SELECT * FROM objets WHERE depart = 'True'"); 
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        Flight::json($results);
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur lors de la récupération des objets : ' . $e->getMessage());
    }
});


Flight::route('GET /api/objets/@id', function($id) {
    $db = renvoieBDD();
    try {
        $sth = $db->prepare("SELECT * FROM objets WHERE id = :id");
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            Flight::json($result);
        } else {
            Flight::halt(404, 'Objet non trouvé');
        }
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur lors de la récupération de l\'objet : ' . $e->getMessage());
    }
});


Flight::route('GET /api/score', function() {
    $db = renvoieBDD();
    $hallOfFame = [];
    try {
        $sth = $db->prepare("SELECT * FROM score");
        $sth->execute();
        $scores = $sth->fetchAll(PDO::FETCH_ASSOC);
        Flight::json($scores);
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur lors de la récupération des scores : ' . $e->getMessage());
    }
});

Flight::start();
?>

