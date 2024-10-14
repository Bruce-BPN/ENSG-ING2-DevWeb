<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Leaflet</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <link rel="stylesheet" href="../assets/style2.css">


  </head>
  <body>
    <div id="entete">
      <form action="" method="get" @submit.prevent="chercheVille">
        <input type="text" name="ville" v-model="text" @input="rechercheVilles">
        <input type="submit" value="Go !">
        <ul id="villes">
          <li v-for="item in retour" @click="chargeGeom(item.insee)">{{item.nom}}</li>
        </ul>
      </form>
    </div>
    <div id="map"></div>
    

    <script src="../assets/map.js"></script>
  </body>
</html>