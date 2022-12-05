<?php include("tabs/tab_average_farm_size.php");
include("map_components/map_head.php");
?>

<script>
  //this is the color of the map!!
  var color = "#9d52ad"
  min = 8;
  max = 52;

  //creating legend of map
  document.getElementById("legend_max").innerHTML = max + " ha"
  document.getElementById("legend_min").innerHTML = min + " ha"

  function get_data() {
    //the json files which were generated in create_data
    var raw_data = <?php include("data/data_districts_average_farm_size.php"); ?>;
    return JSON.parse(raw_data);
  }

  function get_value(feature) {

    //getting the data
    var data = get_data();
    var indexes = get_indexes();

    //this is the id of the feature (map polygon)
    id = Number(feature.id);

    //getting the district name with the id
    district = indexes["District"][id];
    //getting the district average farm size (value) with the district name
    value = Number(data["2021 average farm size"][district]);
    value = (Math.round(value * 100) / 100)
    return value;
  }
</script>

<?php include("map_components/districts_map_init.php"); ?>

<script>
  geo_json_8a893a869ac36e93724032a2dd24d64c.bindTooltip(
    function(layer) {
      let div = L.DomUtil.create("div");

      let handleObject = (feature) =>
        typeof feature == "object" ? JSON.stringify(feature) : feature;

      let fields = ["name"];
      let aliases = ["name"];

      let table =
        "<table>" +
        String(
          fields
          .map(
            (v, i) =>
            `<tr>
            
            <td>${handleObject(layer.feature.properties[v])}</td>
        </tr>
        <tr>
                  <td>${String(get_value(layer.feature)) + " ha"}</td>
                </tr>`
          )
          .join("")
        ) +
        "</table>";
      div.innerHTML = table;

      return div;
    }, {
      className: "foliumtooltip",
      sticky: true
    }
  );
</script>

<!-- IFRAME STUFF: -->
<!-- defining the iframe as detailsCantons.html (done in views) -->
<iframe class="detailsIframe" id="detailsIframe" src="details_page/details_districts.php" title="Details" frameborder="0"></iframe>

<?php include("map_components/details_iframe.php"); ?>

<script>
  //this function is responsible for creating the popup when clicking on a tile
  geo_json_8a893a869ac36e93724032a2dd24d64c.bindPopup(
    function(layer) {

      hideDetails(); //closing the details window when clicking on another region

      current_tile = layer.feature; //updating the current tile
      //creating a div which is then displayed as popup, consisting of a tit
      let div = L.DomUtil.create("div");

      let handleObject = (feature) =>
        typeof feature == "object" ? JSON.stringify(feature) : feature;
      let fields = ["name", "id"];
      let aliases = ["District:", "(TEMPORARY) id:"];
      let title = "<popuptitle>" + get_name(current_tile) + "</popuptitle>";
      let value = "<br><popuptext>The average farm size in '" + get_name(current_tile) + "'' in 2021 was " + get_value(current_tile) + " ha.</popuptext><br>";
      div.innerHTML = title + value + detailsButton;
      return div;
    }, {
      className: "foliumpopup"
    }
  );
</script>