Vue.createApp({
  data() {
      return {
          image: '',
          code: '',
          score: 0,
          map: null,
          group: L.layerGroup(),
          inventaire: L.layerGroup(),
          heatmapLayer: null,
          showHeatmap: false,
      };
  },
  mounted() {
      map = L.map('map').setView([48.841, 2.5872], 19);

      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
      }).addTo(map);

      // 
      // CARTE DE CHALEUR
      //
      this.heatmapLayer = L.tileLayer.wms("http://localhost:8080/geoserver/wms", {
        layers: 'objets',
        format: 'image/png',
        transparent: true,
        tiled: true,
        crs: L.CRS.EPSG4326,
      });
      //
      // FIN DE LA CARTE DE CHALEUR
      //

      this.ajouter();
      console.log("zoom", map.getZoom());
      console.log(this.code);
      map.on('zoomend', this.zoomer);
      this.group.on('click', this.onMapClick)

      const now = new Date();
      const hours = now.getHours(); // Heure locale (0-23)
      const minutes = now.getMinutes(); // Minutes locales (0-59)
      const seconds = now.getSeconds(); // Secondes locales (0-59)

      console.log(`Heure actuelle locale : ${hours}:${minutes}:${seconds}`);
  },
  methods: {
      ajouter() { //On ajoute les objets json sur la carte
          fetch('/api/objets')
              .then(result => result.json())
              .then(result => {
                  console.log(result)
                  this.group.clearLayers();
                  result.forEach(
                      objet => {
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
                          
                          if (objet["id"] == '1') {
                              var marker1 = L.marker([lat, lon], {
                                  icon: icone
                              }).addTo(this.group).on('click', this.onMapClick);
                              marker1.type = objet["type"]
                              marker1.icon = objet["url_icone"]
                              marker1.id = objet["id"]
                          }
                          if (objet["id"] == '2') {
                              var marker2 = L.marker([lat, lon], {
                                  icon: icone
                              }).addTo(this.group).on('click', this.onMapClick);
                              marker2.type = objet["type"]
                              marker2.idBloque = objet["idbloque"]
                          }
                          if (objet["id"] == '4') {
                              var marker3 = L.marker([lat, lon], {
                                  icon: icone
                              }).addTo(this.group).bindPopup("Le code est " + objet["code"]).on('click', this.onMapClick);
                              marker3.type = objet["type"]
                              marker3.code = objet["code"]
                          }
                      })
                  this.group.addTo(map) //on ajoute le groupe de marker à la carte
              })
      },
      toggleHeatmap() {
        // Afficher ou masquer la Heatmap selon la valeur de showHeatmap
        if (this.showHeatmap) {
            this.heatmapLayer.addTo(map);
        } else {
            map.removeLayer(this.heatmapLayer);
        }
    },

      zoomer() { //Affichage des objets en fonction du niveau de zoom de la carte
          var z = map.getZoom();

          if (z < 19) {
              if (map.hasLayer(this.group)) {
                  map.removeLayer(this.group);
              }
              //On supprime le marker en dessous d'un certain niveau de zoom
          } else {
              if (!map.hasLayer(this.group)) {
                  this.group.addTo(map);
              }
          }
      },

      calculTemps(min, sec) { //on calcule le temps mis par le jeu
          let a = (min - minutes) * 60 + (sec - secondes)
          this.score = this.score + 1000 / a
      },

      saveScore(score) {
        fetch('/api/save_score', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ score_value: score }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors de l\'enregistrement du score : ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log('Score sauvegardé avec succès :', data);
        })
      },

      onMapClick(evt) {
          let elem = evt.target
          if (elem.type == "Recuperable") {
            this.inventaire.addLayer(elem);
            this.group.removeLayer(elem);
            map.removeLayer(elem);
            this.image = elem.options.icon.options.iconUrl;
            this.inventaire.icon = elem.options.icon.options.iconUrl;
            this.inventaire.id = elem.id;
            this.score += 100;
        }
          if (elem.type == "Code") {
              this.score = this.score + 100
          }

          if (elem.type == "Bloque_objet") {
              if (elem.idBloque == this.inventaire.id) { //On teste si l'id de l'élément qui bloque l'objet est dans l'inventaire
                  this.score = this.score + 100
                  this.group.removeLayer(elem);
                  fetch('/api/objets/3') //On recupere id du nouvel objet et on l'ajoute à la carte
                      .then(r => r.json())
                      .then(r => {
                          const coords = r["position"];
                          const coords_test = coords.replace(/[{}]/g, '').split(',').map(Number);
                          const taille = r["taille"];
                          const taille_test = taille.replace(/[{}]/g, '').split(',').map(Number);
                          const lat = coords_test[0];
                          const lon = coords_test[1];
                          const icone = L.icon({
                              iconUrl: r["url_icone"],
                              iconSize: [taille_test[0], taille_test[1]],
                          });

                          const marker = L.marker([lat, lon], {
                              icon: icone
                          }).addTo(this.group).on('click', this.onMapClick);
                          marker.type = r["type"];
                          marker.idBloque = r["idbloque"];
                          marker.code = r["code"];

                          if (r["type"] === "Bloque_objet") {
                              marker.bindPopup(`Bloqué par un objet avec l'ID : ${r["idbloque"]}`);
                          } else if (r["type"] === "Code") {
                              marker.bindPopup(`Code : ${r["code"]}`);
                          }
                      })
                      .catch(error => {
                          console.error('Erreur lors du traitement de la réponse :', error);
                      });
              } else {
                  fetch('/api/objets/' + elem.idBloque, { //On recupere l'objet qui bloque
                          method: 'get',
                      })
                      .then(r => r.json())
                      .then(r => {
                          console.log(r); //il faut appuyer 2 fois sur l'objet de la carte pour afficher le popup
                          elem.bindPopup("Bloqué par un " + r[0]["nom"] + " bien utile d'identifiant " + r[0]["id"]);
                      })
              };
          }

          if (elem.type == "Bloque_code") {
            fetch('/api/objets/' + elem.idBloque, { method: 'get' })
                .then(r => r.json())
                .then(objet => {
                    if (!objet || typeof objet !== 'object') {
                        console.error("L'objet retourné par l'API est invalide :", objet);
                        return;
                    }
                    elem.bindPopup("Bloqué par un " + objet.nom + " bien utile d'identifiant " + objet.id);
                    if (this.code == objet.code) {
                        this.score += 100;
                        this.group.removeLayer(elem);
                        this.code = "";
                        fetch('/api/objets/5')
                            .then(r => r.json())
                            .then(newObjet => {
                                if (!newObjet || typeof newObjet !== 'object') {
                                    console.error("L'objet retourné pour le nouvel objet est invalide :", newObjet);
                                    return;
                                }
                                const coords = newObjet["position"].replace(/[{}]/g, '').split(',').map(Number);
                                const taille = newObjet["taille"].replace(/[{}]/g, '').split(',').map(Number);
        
                                const lat = coords[0];
                                const lon = coords[1];
        
                                const icone = L.icon({
                                    iconUrl: newObjet["url_icone"],
                                    iconSize: [taille[0], taille[1]],
                                });

                                const marker5 = L.marker([lat, lon], { icon: icone }).addTo(this.group).on('click', this.onMapClick).bindPopup("Tu as gagné !");
        
                                marker5.type = newObjet["type"];
                            })
                            .catch(error => {
                                console.error('Erreur lors de la récupération du nouvel objet :', error);
                            });
                    } else {
                        console.log("Code incorrect :", this.code, "attendu :", objet.code);
                        elem.bindPopup("Code incorrect ! Réessayez.").openPopup();
                    }
                })
                .catch(error => {
                    console.error("Erreur lors de la récupération de l'objet bloquant : ", error);
                });
                // Ajout du score dans le temps non fonctionnel
                // this.calculTemps(now.getMinutes(), now.getSeconds());
                this.saveScore(this.score);
                console.log(this.score);
        }
        
      },
  },
  watch: {
    showHeatmap() {
        this.toggleHeatmap();
    },
},
}).mount('#app');