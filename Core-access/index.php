<?php
declare(strict_types=1);
session_start();

require_once 'flight/Flight.php';
// require 'flight/autoload.php';

function renvoieBDD() {
    try {
        // Connexion via PDO pour PostgreSQL
        $db = new PDO("pgsql:host=localhost;port=5432;dbname=objets", "postgres", "admin");
        
        // Configurer PDO pour lancer des exceptions en cas d'erreur
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur de connexion à la base de données : ' . $e->getMessage());
        exit;
    }
}

Flight::route('/', function() {
    $db = renvoieBDD();
    try {
        $sth = $db->prepare("SELECT * FROM score ORDER BY score DESC"); // Moins casse-pieds que de passer par Fetch
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats

        // Passer les scores à la vue
        Flight::render('accueil', ['results' => $results]); 
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur lors de la récupération des scores : ' . $e->getMessage());
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
