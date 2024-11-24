<?php
declare(strict_types=1);
session_start();

require_once 'flight/Flight.php';
// require 'flight/autoload.php';

Flight::set('pseudo', null); // Le pseudo du joueur (initialement null)
Flight::set('score_value', 10); // Score par défaut (modifiable)



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
    // Récupérer le pseudo de la session s'il existe
    $pseudo = $_SESSION['pseudo'] ?? null;

    $db = renvoieBDD();
    try {
        $sth = $db->prepare("SELECT * FROM score ORDER BY value DESC LIMIT 10"); // Récupération des scores
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats

        // Passer les scores et le pseudo à la vue
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

    // Mettre à jour la variable globale du pseudo
    Flight::set('pseudo', $pseudo);
    Flight::redirect('/'); // Redirection vers la page d'accueil
});

Flight::route('POST /api/save_score', function() {
    // Récupérer le pseudo de la session s'il existe
    $pseudo = $_SESSION['pseudo'] ?? null;

    // Pseudo et score
    $pseudo = $_SESSION['pseudo'];
    $score_value = 10; // Valeur du score

    // Sauvegarde dans la base de données
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

// Route pour récupérer des objets
Flight::route('GET /api/objets', function() {
    $db = renvoieBDD();
    $objets = [];
    try {
        $sth = $db->prepare("SELECT * FROM objets WHERE depart = 'True'"); // Sélection des objets de départ
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        Flight::json($results); // Retourne les objets en JSON
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur lors de la récupération des objets : ' . $e->getMessage());
    }
});

// Route pour récupérer un objet avec un identifiant spécifique
Flight::route('GET /api/objets/@id', function($id) {
    $db = renvoieBDD();
    try {
        $sth = $db->prepare("SELECT * FROM objets WHERE id = :id"); // Préparation de la requête avec paramètre
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            Flight::json($result); // Renvoie l'objet en JSON
        } else {
            Flight::halt(404, 'Objet non trouvé');
        }
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur lors de la récupération de l\'objet : ' . $e->getMessage());
    }
});

// Route pour récupérer le score
Flight::route('GET /api/score', function() {
    $db = renvoieBDD();
    $hallOfFame = [];
    try {
        $sth = $db->prepare("SELECT * FROM score"); // Sélection des scores METTRE UN ORDER BY
        $sth->execute();
        $scores = $sth->fetchAll(PDO::FETCH_ASSOC);
        Flight::json($scores); // Retourne les scores en JSON
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur lors de la récupération des scores : ' . $e->getMessage());
    }
});

Flight::start();
?>
