Vue.createApp({
  data() {
    return {
      image:'',
      nombre:'',
      map: null,
      group:L.layerGroup(),
      objets:[],
      objet_N:[],
      tab:[],
      inventaire:L.featureGroup(),
    };
  },
  mounted() {
    map = L.map('map').setView([48.841, 2.5872], 19);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    this.ajouter();
    //map.on('click', this.onMapClick);


    //var livre = L.icon({
    //    iconUrl: 'images/livre_729.jpg',
    //    iconSize: [66, 80],
    //})

    //var marker = L.marker([48.841, 2.5872], {icon: livre}).addTo(map).bindPopup("Début de l'enquête!");; //test à mettre dans BD
    
  },
  methods: {
    ajouter () {  //On ajoute les objets json sur la carte
      fetch('/api/objets')
        .then(result => result.json())
        .then(result => {
          console.log(result)
          this.group.clearLayers();
          result.forEach(
            objet =>{
              let coords = objet["position"]
              let coords_test = coords.replace(/[{}]/g, '').split(',').map(Number)
              let lat = coords_test[0]
              let lon = coords_test[1]
              console.log(lat, lon)
              var marker = L.marker([lat, lon]).addTo(this.group);
          })
          this.group.addTo(map)
        })
    },
    
    zoomer () { //Affichage des objets en fonction du niveau de zoom de la carte
      map.on('zoomend', function(marker){ 
        var z = map.getZoom();
      
        if(z <= 18){ 
          marker.remove(); //On supprime le marker en dessous d'un certain niveau de zoom
        } else {
          marker.addTo(map);
        }
    });
    },
    identifier () { //On sélectionne l'objet json en fonction de son id
      let donnees = new FormData()
      donnees.append('texte', this.texte)
      console.log(donnees)
      fetch('/api/objets/N', {
        method: 'get',
        body: donnees,
      })
      .then(result => result.json())
      .then(result => {
        this.objet_N = result;
      })
    },
    onMapClick(elem) {
      console.log(elem);
        if(elem.type = "Récupérable"){
          this.inventaire.addLayer(elem) //On ajoute l'objet à l'inventaire
          elem.clearLayers()  //On enlève l'objet de la carte        
        }

        if(elem.type = "Code"){
          elem.bindPopup("Le code est" + elem.code) //On affiche le code lorsque l'on clique sur l'objet
        }

        if(elem.type = "Bloqué par objet"){
          function test(id, inv){ //fonction test qui compare l'identifiant d'un objet dans l'inventaire avec un autre id
            let res = false
            inv.eachLayer(function (layer) {
              if (layer.id == id) {
                  res = true;
              }});
          return res;
          }
          if(test(elem.idBloque,this.inventaire)){  //On teste si l'id de l'élément qui bloque l'objet est dans l'inventaire
            fetch('/api/objets/N', { //On recupere id du nouvel objet et on l'ajoute à la carte
              method: 'get',
              body: donnees,
            })
            .then(r => r.json())
            .then(r => {
              console.log(r);
              this.objet_N = r.id;
              r.addTo(map)
            })
          }else{
            fetch('/api/objets/N', { //On recupere id de l'objet qui bloque
              method: 'get',
              body: donnees,
            })
            .then(r => r.json())
            .then(r => {
              console.log(r);
              this.objet_N = r.idbloque;
            })
          };
        }

        if(elem.type = "Bloqué par code"){
          fetch('/api/objets/N', { //On recupere id de l'objet qui bloque
            method: 'get',
            body: donnees,
          })
          .then(r => r.json())
          .then(r => {
            console.log(r);
            this.objet_N = r.idbloque;
          })
        }
    },
    },
}).mount('#map');

