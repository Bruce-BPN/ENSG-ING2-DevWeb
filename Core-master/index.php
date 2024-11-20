<?php
declare(strict_types=1);
session_start();

require_once 'flight/Flight.php';
// require 'flight/autoload.php';

function renvoieBDD(){
     try {
        $db = new PDO("pgsql:host=localhost;dbname=objets", "postgres", "VI22ol14");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    }
    return $db;
}
   


Flight::route('/', function() {
    Flight::render('accueil');
});

Flight::route('/carte', function() {
    Flight::render('carte');
});

Flight::route('GET /api/objets', function() {
    $db = renvoieBDD();
    $objets = [];
    $sth = $db->prepare("SELECT * FROM objets WHERE depart = 'True'"); //On sélectionne les objets de départ
    $sth -> execute();
    $results = $sth->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($results); //On renvoie les objets en json
});

Flight::route('GET/api/objets/N', function() {
    $link = Flight::get('db');
    $N = $_GET['nombre']
    $sql = "SELECT * FROM db WHERE id = $N"; //On sélectionne l'objet avec l'identifiant N
    $objets = mysqli_query($link,$sql);  
    Flight::json(['objet_N' => $objets]); //On renvoie l'objet en json
});


Flight::start();
