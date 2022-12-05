<body>
  <div class="folium-map" id="map"></div>
</body>

<script>
  //coordinates of lower left and upper right corner of map when first displayed
  var bounds = [
      [45.818078380326554, 5.9532480372932906],
      [48.092333, 10.510867],
    ];

    var legend = document.querySelector('.legend');
  legend.style.background = get_legend();

  //function to write css of legend
  function get_legend(){
    return "linear-gradient(to right, white," + color + ")";
  }


  var map = L.map(
    "map",
    {
      attributionControl: false,
      center: [46.812976904438315, 8.223948423498864],
      crs: L.CRS.EPSG3857,
      //set to 10 to have map quickly zoom out upon opening
      zoom: 0,
      zoomControl: false,
      preferCanvas: false,
      maxBounds: bounds,
      //making sure you can't scroll away or zoom out too much
      maxBoundsViscosity: 1.0,
      minZoom: 7.5,
    }
  );
  //adding zoom and scale to bottom corners
  L.control.zoom({position: 'bottomleft'}).addTo(map);
  L.control.scale({position: 'bottomright'}).addTo(map);

    //adding a white background layer
    //TODO : change this to a local file
    var imageUrl = 'https://www.colorhexa.com/ffffff.png',
        imageBounds = [[55,-10], [30,30]];

    L.imageOverlay(imageUrl, imageBounds).addTo(map);

    //fitting the map to the bounds defined above
    map.fitBounds(
        bounds,
        {}
    );

    function get_indexes(){
    //the same indexing which is used by the map
    var raw_indexes = <?php include('data/indexes_cantons.php'); ?>
    
    return JSON.parse(raw_indexes);
  }

  //function which returns name of feature (+1 because Switzerland is included)
  function get_name(feature){
    let indexes = get_indexes();
    return indexes["Canton"][Number(feature.id)+1];

  }

    //this function is used to fill the different tiles
  function geo_json_4757a7460976929ab0308bc59cf096c8_styler(feature) {
    //getting the cantonal average farm size
    value = get_value(feature);

    //returning a fill-color depending on the value
    return { fillOpacity: (value -min) / (max-min), weight: 1, color: color };
  }

  //this function is called to fill the tile which we are hovering over
  function geo_json_4757a7460976929ab0308bc59cf096c8_highlighter(feature) {

      //getting the cantonal average farm size
        value = get_value(feature);
        //returning a fill-color depending on the value
        return { fillOpacity: (value -min) / (max-min), weight: 5, color: color };
    
  }
  function geo_json_4757a7460976929ab0308bc59cf096c8_pointToLayer(
    feature,
    latlng
  ) {
    var opts = {
      bubblingMouseEvents: true,
      color: "#3388ff",
      dashArray: null,
      dashOffset: null,
      fill: true,
      fillColor: "#3388ff",
      fillOpacity: 1,
      fillRule: "evenodd",
      lineCap: "round",
      lineJoin: "round",
      opacity: 1.0,
      radius: 2,
      stroke: true,
      weight: 3,
    };

    let style = geo_json_4757a7460976929ab0308bc59cf096c8_styler(feature);
    Object.assign(opts, style);

    return new L.CircleMarker(latlng, opts);
  }

  function geo_json_4757a7460976929ab0308bc59cf096c8_onEachFeature(
    feature,
    layer
  ) {
    layer.on({
      mouseout: function (e) {
        if (typeof e.target.setStyle === "function") {
          geo_json_4757a7460976929ab0308bc59cf096c8.resetStyle(e.target);
        }
      },
      mouseover: function (e) {
        if (typeof e.target.setStyle === "function") {
          var layer = e.target;
          const highlightStyle =
            geo_json_4757a7460976929ab0308bc59cf096c8_highlighter(
              e.target.feature
            );
          e.target.setStyle(highlightStyle);
        }
      },
    });
  }
  var geo_json_4757a7460976929ab0308bc59cf096c8 = L.geoJson(null, {
    onEachFeature: geo_json_4757a7460976929ab0308bc59cf096c8_onEachFeature,

    style: geo_json_4757a7460976929ab0308bc59cf096c8_styler,
    pointToLayer: geo_json_4757a7460976929ab0308bc59cf096c8_pointToLayer,
  });

  function geo_json_4757a7460976929ab0308bc59cf096c8_add(data) {
    geo_json_4757a7460976929ab0308bc59cf096c8
      .addData(data)
      .addTo(map);
  }

  //get the coordinates from another php file
  geo_json_4757a7460976929ab0308bc59cf096c8_add(

    <?php include("map_cantons_coordinates.php");?>
    
    );

</script>