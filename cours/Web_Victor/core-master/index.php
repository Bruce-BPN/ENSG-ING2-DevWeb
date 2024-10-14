<?php
declare(strict_types=1);
session_start();
require_once 'flight/Flight.php';
// require 'flight/autoload.php';

$link = mysqli_connect('u2.ensg.eu', 'geo', '', 'geobase');
Flight::set('db', $link);

Flight::route('/', function () {
    Flight::render('accueil');
});

Flight::route('/aujourdhui', function () {
    $date = date("w");
    Flight::render('today', ['dateJour' => $date]);
});

// Flight::route('GET /ident', function () {
//     Flight::render('identification', ['user' => $_SESSION]);
// });
Flight::route('GET /ident', function () {
    Flight::render('identification', ['user' => $_SESSION]);
});

Flight::route('POST /ident', function () {
    if (isset($_POST['log']) and !empty($_POST['log'])){
        $_SESSION['log'] = $_POST['log'];
        $_SESSION['pass'] = $_POST['pass'];
        Flight::render('identification', ['user' => $_SESSION]);
    }
});


Flight::route('GET /logout', function () {
    $_SESSION = [];
    Flight::render('identification', ['user' => $_SESSION]);
});


Flight::route('/departements', function () {
    $base = Flight::get('db');
    if (isset($_GET['reg'])){
        $results = mysqli_query($base, "SELECT insee, nom FROM departements WHERE region_insee=".$_GET['reg']);
        $lesregions = mysqli_query($base, "SELECT insee, nom FROM regions ORDER BY nom");
        Flight::render('departements', ['depart' => $results, 'region' => $lesregions]);
    }else{
        $lesregions = mysqli_query($base, "SELECT insee, nom FROM regions ORDER BY nom");
        Flight::render('departements', ['depart' => null, 'region' => $lesregions]);
    }
    
});


Flight::route('/javascript', function () {
    Flight::render('nombre');
});

Flight::route('/map', function () {
    Flight::render('map');
});

Flight::route('POST /villes', function () {
    $base = Flight::get('db');
    if(isset($_POST["recherche"])){
        $resultCommune = mysqli_query($base,"SELECT insee, nom FROM communes WHERE nom LIKE '".$_POST["recherche"]."%' ORDER BY nom LIMIT 10;");
        $communes = [];
        foreach($resultCommune as $key => $com){
            $communes[] = $com;
        }
        Flight::json(['id'=>$communes]);
    }elseif(isset($_POST["n_insee"])){
        $resultGeom = mysqli_query($base,"SELECT ST_AsGeoJson(geometry) AS geom FROM communes WHERE insee = '".$_POST["n_insee"]."';");
        $geometry = [];
        foreach($resultGeom as $key => $g){
            $geometry[] = json_decode($g['geom']);
        }
        Flight::json(['id_bis'=>$geometry]);
    }
    //connect BDD
    //Recupere $_POST
    //Requete SQL les noms des villes qui part la valeur dans $_POST
    //Flight::json('id' => resultat)
});

Flight::route('/openL', function () {
    Flight::render('openL');
});

Flight::start();
