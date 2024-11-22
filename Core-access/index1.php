<?php
declare(strict_types=1);
session_start();

require_once 'flight/Flight.php';

function renvoieBDD() {
    try {
        $db = new PDO("pgsql:host=localhost;port=5432;dbname=objets", "postgres", "admin");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur de connexion à la base de données : ' . $e->getMessage());
        exit;
    }
    return $db;
}

// Configuration de la base de données pour Flight
Flight::set('db', renvoieBDD());

// Routes
Flight::route('/', function() {
    Flight::render('accueil');
});

Flight::route('/carte', function() {
    Flight::render('carte');
});

// API pour récupérer les objets de départ
Flight::route('GET /api/objets', function() {
    $db = Flight::get('db');
    try {
        $sth = $db->prepare("SELECT * FROM objets WHERE depart = 'True'");
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        Flight::json($results); // Retourne les objets en JSON
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur lors de la récupération des objets : ' . $e->getMessage());
    }
});

// API pour récupérer un objet spécifique par ID
Flight::route('GET /api/objets/@id', function($id) {
    $db = Flight::get('db');
    try {
        $sth = $db->prepare("SELECT * FROM objets WHERE id = :id");
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            Flight::json($result);
        } else {
            Flight::halt(404, 'Objet non trouvé.');
        }
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur lors de la récupération de l\'objet : ' . $e->getMessage());
    }
});

Flight::start();
