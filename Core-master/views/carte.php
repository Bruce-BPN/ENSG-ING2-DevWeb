<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Carte</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div id="entete">
    <h1>Carte du jeu</h1>
</div>
<div id="inventaire">Nos objets
    <div id="app">
    {{ inventaire }}
    </div>
</div>

<div id="map" @zoomend='zoomer'></div>

<form action="" method="get" @submit.prevent="">

<script src="assets/geo.js"></script>
</body>
</html>
