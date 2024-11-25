<?php
declare(strict_types=1);
session_start();

require_once 'flight/Flight.php';
// require 'flight/autoload.php';

function renvoieBDD() {
    try {
        #$db = new PDO("pgsql:host=localhost;port=5432;dbname=objets", "postgres", "admin");
        $db = pg_connect("host=localhost port=5432 dbname=objets user=postgres password=admin");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        Flight::halt(500, 'Erreur de connexion à la base de données : ' . $e->getMessage());
        exit;
    }
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
    $N = $_GET['nombre'];
    $sql = "SELECT * FROM db WHERE id = $N"; //On sélectionne l'objet avec l'identifiant N
    $objets = mysqli_query($link,$sql);  
    Flight::json(['objet_N' => $objets]); //On renvoie l'objet en json
});


Flight::start();
