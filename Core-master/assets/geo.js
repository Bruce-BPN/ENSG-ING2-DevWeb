Vue.createApp({
  data() {
    return {
      image:'',
      code:'',
      score:0,
      map: null,
      group:L.layerGroup(),
      inventaire:L.layerGroup(),
    };
  },
  mounted() {
    this.map = L.map('map').setView([48.841, 2.5872], 19);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(this.map);

    this.ajouter();
    console.log("zoom", this.map.getZoom());
    console.log(this.code);
    this.map.on('zoomend', this.zoomer);
    this.group.on('click',this.onMapClick)

    const now = new Date();
    const hours = now.getHours(); // Heure locale (0-23)
    const minutes = now.getMinutes(); // Minutes locales (0-59)
    const seconds = now.getSeconds(); // Secondes locales (0-59)

    console.log(`Heure actuelle locale : ${hours}:${minutes}:${seconds}`);

    
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
              let taille = objet["taille"]
              let taille_test = taille.replace(/[{}]/g, '').split(',').map(Number)
              let lat = coords_test[0]
              let lon = coords_test[1]
              let icone = L.icon({
                iconUrl: objet["url_icone"],
                iconSize: [taille_test[0], taille_test[1]],
              })
              //console.log(lat, lon)
              //console.log(objet["type"])
              if (objet["id"]=='1') {
                var marker1 = L.marker([lat, lon], {icon: icone}).addTo(this.group).on('click',this.onMapClick);
                marker1.type = objet["type"]
                marker1.icon = objet["url_icone"]
                marker1.id = objet["id"]
              }
              if (objet["id"]=='2') {
                var marker2 = L.marker([lat, lon], {icon: icone}).addTo(this.group).on('click',this.onMapClick);
                marker2.type = objet["type"]
                marker2.idBloque = objet["idbloque"]
              }
              if (objet["id"]=='4') {
                var marker3 = L.marker([lat, lon], {icon: icone}).addTo(this.group).bindPopup("Le code est " + objet["code"]).on('click',this.onMapClick);
                marker3.type = objet["type"]
                marker3.code = objet["code"]
              }
          })
          this.group.addTo(this.map) //on ajoute le groupe de marker à la carte
        })
    },
    
    zoomer () { //Affichage des objets en fonction du niveau de zoom de la carte
        var z = this.map.getZoom();
      
        if(z < 19){
          if (this.map.hasLayer(this.group)) {
            this.map.removeLayer(this.group);
          }          
          //On supprime le marker en dessous d'un certain niveau de zoom
        } else {
          if (!this.map.hasLayer(this.group)) {   
            this.group.addTo(this.map);
        }}
    },

    calculTemps(min,sec) { //on calcule le temps mis par le jeu
      let a = (min - minutes)*60+(sec - secondes)
      this.score = this.score + 1000/a
      console.log(this.score)
    },

    onMapClick(evt) {
      let elem = evt.target
      console.log('+click');
      console.log(elem)
        if(elem.type == "Récupérable"){
          this.inventaire.addLayer(elem) //On ajoute l'objet à l'inventaire
          this.group.removeLayer(elem)
          this.image = elem.icon
          this.inventaire.icon = elem.icon
          this.inventaire.id = elem.id
          console.log(this.image)
          this.score = this.score + 10
          this.map.removeLayer(elem)  //On enlève l'objet de la carte        
        }

        if(elem.type == "Code"){
          this.score = this.score + 10
          console.log('affichage du code')
          //On affiche le code lorsque l'on clique sur l'objet
        }

        if(elem.type == "Bloqué par objet"){
          if(elem.idBloque == this.inventaire.id) {  //On teste si l'id de l'élément qui bloque l'objet est dans l'inventaire
            this.score = this.score + 10
            fetch('/api/objets/3')//On recupere id du nouvel objet et on l'ajoute à la carte
            .then(r => r.json())
            .then(r => {
              console.log(r);
              this.group.removeLayer(elem);
              this.image = ""
              this.map.removeLayer(elem);
              r.forEach(
                objet =>{
                  var coords = objet["position"]
                  //console.log(coords)
                  var coords_test = coords.replace(/[{}]/g, '').split(',').map(Number)
                  var taille = objet["taille"]
                  var taille_test = taille.replace(/[{}]/g, '').split(',').map(Number)
                  var lat = coords_test[0]
                  var lon = coords_test[1]
                  var icone = L.icon({
                    iconUrl: objet["url_icone"],
                    iconSize: [taille_test[0], taille_test[1]],
                  })
                var marker4 = L.marker([lat, lon], {icon: icone}).addTo(this.group).on('click',this.onMapClick);
                marker4.type = objet["type"]
                marker4.idBloque = objet["idbloque"]
            })})
          }else{
            fetch('/api/objets/'+elem.idBloque, { //On recupere l'objet qui bloque
              method: 'get',
            })
            .then(r => r.json())
            .then(r => {
              console.log(r); //il faut appuyer 2 fois sur l'objet de la carte pour afficher le popup
              elem.bindPopup("Bloqué par un "+r[0]["nom"]+" bien utile d'identifiant "+r[0]["id"]);
            })
          };
        }

        if(elem.type == "Bloqué par code"){
          fetch('/api/objets/'+elem.idBloque, { //On recupere l'objet qui bloque
            method: 'get',
          })
          .then(r => r.json())
          .then(r => {
            console.log(r); //il faut appuyer 2 fois sur l'objet de la carte pour afficher le popup
            elem.bindPopup("Bloqué par un "+r[0]["nom"]+" bien utile d'identifiant "+r[0]["id"]) //On affiche l'indice sur l'objet code
          })
          console.log(this.code)
          if (this.code==elem.code){
            this.score = this.score + 10
            fetch('/api/objets/5')//On recupere id du nouvel objet et on l'ajoute à la carte
            .then(r => r.json())
            .then(r => {
              console.log(r);
              this.group.removeLayer(elem);
              this.code = ""
              this.map.removeLayer(elem);
              r.forEach(
                objet =>{
                  var coords = objet["position"]
                  //console.log(coords)
                  var coords_test = coords.replace(/[{}]/g, '').split(',').map(Number)
                  var taille = objet["taille"]
                  var taille_test = taille.replace(/[{}]/g, '').split(',').map(Number)
                  var lat = coords_test[0]
                  var lon = coords_test[1]
                  var icone = L.icon({
                    iconUrl: objet["url_icone"],
                    iconSize: [taille_test[0], taille_test[1]],
                  })
                var marker5 = L.marker([lat, lon], {icon: icone}).addTo(this.group).bindPopup("Tu as gagné !").on('click',this.onMapClick);
                marker5.type = objet["type"]
                this.calculTemps(now.getMinutes(),now.getSeconds()) //on calcule le temps mis par le jeu
            })})
          }
        }
    },
    },
}).mount('#map');

