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
  function get_legend() {
    return "linear-gradient(to right, white," + color + ")";
  }


  var map = L.map(
    "map", {
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
  L.control.zoom({
    position: 'bottomleft'
  }).addTo(map);
  L.control.scale({
    position: 'bottomright'
  }).addTo(map);

  //adding a white background layer
  //TODO : change this to a local file
  var imageUrl = 'https://www.colorhexa.com/ffffff.png',
    imageBounds = [
      [55, -10],
      [30, 30]
    ];

  L.imageOverlay(imageUrl, imageBounds).addTo(map);

  //fitting the map to the bounds defined above
  map.fitBounds(
    bounds, {}
  );

  function get_indexes() {
    //the same indexing which is used by the map
    var raw_indexes = <?php include('data/indexes_districts.php'); ?>

    return JSON.parse(raw_indexes);
  }


  //function which returns name of feature
  function get_name(feature) {
    let indexes = get_indexes();
    let full_name = indexes["District"][Number(feature.id)]
    return full_name.slice(3, full_name.length);
  }

  //this function is used to fill the different tiles
  function geo_json_8a893a869ac36e93724032a2dd24d64c_styler(feature) {
    //getting the district average farm size
    value = get_value(feature);

    //returning a fill-color depending on the value
    return {
      fillOpacity: (value - min) / (max - min),
      weight: 0.5,
      color: color
    };
  }

  //this function is called to fill the tile which we are hovering over
  function geo_json_8a893a869ac36e93724032a2dd24d64c_highlighter(feature) {

    //getting the district average farm size
    value = get_value(feature);
    //returning a fill-color depending on the value


    return {
      fillOpacity: (value - min) / (max - min),
      weight: 3,
      color: color
    };

  }

  function geo_json_8a893a869ac36e93724032a2dd24d64c_pointToLayer(
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
      fillOpacity: 0.2,
      fillRule: "evenodd",
      lineCap: "round",
      lineJoin: "round",
      opacity: 1.0,
      radius: 2,
      stroke: true,
      weight: 3,
    };

    let style = geo_json_8a893a869ac36e93724032a2dd24d64c_styler(feature);
    Object.assign(opts, style);

    return new L.CircleMarker(latlng, opts);
  }

  function geo_json_8a893a869ac36e93724032a2dd24d64c_onEachFeature(
    feature,
    layer
  ) {
    layer.on({
      mouseout: function(e) {
        if (typeof e.target.setStyle === "function") {
          geo_json_8a893a869ac36e93724032a2dd24d64c.resetStyle(e.target);
        }
      },
      mouseover: function(e) {
        if (typeof e.target.setStyle === "function") {

          const highlightStyle =
            geo_json_8a893a869ac36e93724032a2dd24d64c_highlighter(
              e.target.feature
            );
          e.target.setStyle(highlightStyle);
        }
      },
    });
  }
  var geo_json_8a893a869ac36e93724032a2dd24d64c = L.geoJson(null, {
    onEachFeature: geo_json_8a893a869ac36e93724032a2dd24d64c_onEachFeature,

    style: geo_json_8a893a869ac36e93724032a2dd24d64c_styler,
    pointToLayer: geo_json_8a893a869ac36e93724032a2dd24d64c_pointToLayer,
  });

  function geo_json_8a893a869ac36e93724032a2dd24d64c_add(data) {
    geo_json_8a893a869ac36e93724032a2dd24d64c
      .addData(data)
      .addTo(map);
  }

  //get the coordinates from another php file
  geo_json_8a893a869ac36e93724032a2dd24d64c_add(

    <?php include("map_districts_coordinates.php"); ?>

  );

  // source: https://github.com/Leaflet/Leaflet/issues/2896
  /*HGH LATITUDE POPUPS OPENING DOWNWARD instead of UPWARD - prevent yoyo effect*/
  map.on('popupopen', function(e) {

    // saving old anchor point X Y
    if (!e.popup.options.oldOffset) e.popup.options.oldOffset = e.popup.options.offset;
    var px = map.project(e.popup._latlng);
    // we calculate popup content height (jQuery)
    var heightOpeningPopup = $('#map').find('.leaflet-popup-content').height();
    var temp = px.y - heightOpeningPopup;
    console.log(temp)
    var temp2 = heightOpeningPopup + 58.5;
    if (temp < 22800) { // if it will go above the world, we prevent it to do so
      // we make the popup go below the poi instead of above
      e.popup.options.offset = new L.Point(6, temp2);
      // we make the popup tip to be pointing upward (jQuery)
      $('#map').addClass("reverse-popup");
      e.popup.update();
    } else { // we allow auto pan if the popup can open in the normal upward way
      e.popup.options.offset = e.popup.options.oldOffset;
      e.popup.options.autoPan = true;
      $('#map').removeClass("reverse-popup");
      e.popup.update();
    }
  });

  map.on('popupclose', function(e) {
    e.popup.options.autoPan = false;
  });
</script>