var map = L.map('map').setView([51.505, -0.09], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

function onMapClick(e) {
    console.log(e);
}

map.on('click', onMapClick);


let pos;

// navigator.geolocation.getCurrentPosition(function (position) {
//     pos=position;
//     console.log(position.coords.latitude, position.coords.longitude, position.coords.altitude);
//     let mark = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
//   });

// console.log(pos);



///////Exercice - Service Web Base Adresse#

Vue.createApp({
    data() {
      return {
        text: '',
        groupe: L.featureGroup(),
        groupe2: L.featureGroup(),
        retour:{},
      };
    },
    methods: {
      chercheVille () {
        fetch('http://api-adresse.data.gouv.fr/search/?q=' + this.text)
        .then(result => result.json())
        .then(r => {
            this.groupe.clearLayers();
            r.features.forEach(elem => {
                // console.log(elem.geometry.coordinates)
                let mark2 = L.marker(elem.geometry.coordinates.reverse());
                this.groupe.addLayer(mark2);
            })
            this.groupe.addTo(map);
            map.fitBounds(this.groupe.getBounds());
        })
      },
      rechercheVilles(){

        let donnees = 'recherche=' + this.text.replace("'","\\'");

        fetch('/villes', {
          method: 'post',
          body: donnees,
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        })
        .then(r => r.json())
        .then(r => {
          console.log(r);
          this.retour = r.id;
        })
      },
      chargeGeom(num_insee){
        //console.log("coucou");
        let donnees = 'n_insee='+num_insee;

        fetch('/villes', {
          method: 'post',
          body: donnees,
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        })
        .then(r => r.json())
        .then(r => {
          this.groupe2.clearLayers();
          console.log(r.id_bis);
          geoJ = L.geoJSON(r.id_bis);
          this.groupe2.addLayer(geoJ);
          this.groupe2.addTo(map);
          map.fitBounds(this.groupe2.getBounds());
        })
      }
    },
    
  }).mount('#entete');