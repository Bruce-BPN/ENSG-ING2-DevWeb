let map = new ol.Map({
    target: 'map',
    view: new ol.View({
        center: ol.proj.fromLonLat([2.35, 48.85]),
        zoom: 13,
    }),
    layers: [
        new ol.layer.Tile({
            source: new ol.source.XYZ({
                url: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }),
        }),
    ],
});

let wmsSource = new ol.source.TileWMS({
    url: 'http://localhost:8080/geoserver/wms',
    params: {'LAYERS': 'victor:lines', 'TILED': true},
})

var monLayer = new ol.layer.Tile({
    source: wmsSource,
});

map.addLayer(monLayer);

let vecLayer = new ol.layer.Vector({
    source: new ol.source.Vector(),
    style: new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'red',
            width: 5,
        }),
    }),
});

map.addLayer(vecLayer);


Vue.createApp({
    data() {
      return {
        text: 'test',
      };
    },
    mounted() {
        map.on('click', evt => {
            let viewResolution = map.getView().getResolution();
            let url = wmsSource.getFeatureInfoUrl(
                evt.coordinate, // la coordonnée cliquée
                viewResolution,
                'EPSG:3857', // projection par défaut dans OpenLayers
                {'INFO_FORMAT': 'application/json'} // format de retour souhaité
            );
            fetch(url)
            .then(r=>r.json())
            .then(r => {
                console.log(r.features[0].properties.topooh);
                vecLayer.getSource().clear()
                let features = new ol.format.GeoJSON().readFeatures(r);
                vecLayer.getSource().addFeatures(features);
                this.text = r.features[0].properties.topooh;
            })
        });
    },
  }).mount('#app');