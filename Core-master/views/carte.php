<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>ENSGéoGame</title>
        <link rel="icon" href="./assets/images/images.jfif">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/geo.css">
        <link rel="stylesheet" href="assets/css/global.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
            crossorigin=""/>

        <script src="https://cdn.jsdelivr.net/npm/vue"></script>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
            

    </head>
    <body>
        <div id='app'>
            <h1>Carte du jeu</h1>
            <div id="entete">
                <div><a href="/" title="Retour au menu principal">Retour au menu principal</a></div>
                <div><input type="text" name="code" v-model="code" placeholder="Saisir le code"></div>
                <div><label>
                    <input type="checkbox" v-model="showHeatmap"> Afficher la triche
                </label></div>
            </div>
            <div id="inventaire">
                <div><p>Nos objets</p></div>
                <div><img v-show="image" id="objets" :src="image" :alt="Livre" /></div>
            </div>
            <div id="map" @zoomend='zoomer'></div>
        </div>
        <script src="assets/geo.js"></script>
    </body>
</html>
