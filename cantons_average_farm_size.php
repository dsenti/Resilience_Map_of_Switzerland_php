<?php include("tabs/tab_average_farm_size.php");
include("map_components/map_head.php");
?>


<script>
  //this is the color of the map!!
  var color = "#9d52ad"
  var min = 12;
  var max = 42;

  //creating legend of map
  document.getElementById("legend_max").innerHTML = max + " ha"
  document.getElementById("legend_min").innerHTML = min + " ha"

  function get_data() {
    //the json files which were generated in create_data
    var raw_data = <?php include('data/data_cantons_average_farm_size.php'); ?>;
    return JSON.parse(raw_data);
  }

  function get_value(feature) {

    //getting the data
    var data = get_data();
    var indexes = get_indexes();

    //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
    id = Number(feature.id);
    id += 1;

    //getting the canton name with the id
    canton = indexes["Canton"][id];
    //getting the cantonal average farm size (value) with the canton name
    value = Number(data["2021 average farm size"][canton]);
    value = Math.round(value * 10) / 10
    return value;
  }

  function get_number_of_farms(feature) {

    //getting the data
    var data = get_data();
    var indexes = get_indexes();

    //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
    id = Number(feature.id);
    id += 1;

    //getting the canton name with the id
    canton = indexes["Canton"][id];
    //getting the cantonal number of farms (value) with the canton name
    value = Number(data["2021 number of farms"][canton]);
    value = Math.round(value * 100) / 100
    return value;
  }

  function get_total_farm_area(feature) {

    //getting the data
    var data = get_data();
    var indexes = get_indexes();

    //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
    id = Number(feature.id);
    id += 1;

    //getting the canton name with the id
    canton = indexes["Canton"][id];
    //getting the cantonal total farm area (value) with the canton name
    value = Number(data["2021 total farm area"][canton]);
    value = Math.round(value * 100) / 100
    return value;
  }
</script>

</script>

<?php include("map_components/cantons_map_init.php"); ?>

<script>
  geo_json_4757a7460976929ab0308bc59cf096c8.bindTooltip(
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
<!-- defining the iframe as detailsCantons.php -->
<iframe class="detailsIframe" id="detailsIframe" src="details_page/details_cantons.php" title="Details" frameborder="0"></iframe>

<?php include("map_components/details_iframe.php"); ?>

<script>
  //this function is responsible for creating the popup when clicking on a tile
  geo_json_4757a7460976929ab0308bc59cf096c8.bindPopup(
    function(layer) {
      hideDetails(); //closing the details window when clicking on another region
      current_tile = layer.feature; //updating the current tile
      //creating a div which is then displayed as popup, consisting of a title, a short sentence (value) and the button which opens the details tab
      let div = L.DomUtil.create("div");

      let handleObject = (feature) =>
        typeof feature == "object" ? JSON.stringify(feature) : feature;
      let fields = ["name", "id"];
      let aliases = ["Canton:", "(TEMPORARY) id:"];
      let title = "<popuptitle>" + get_name(current_tile) + "</popuptitle>";
      let number_of_farms = "<br><popuptext>In 2021: <br>- The number of farms was " + get_number_of_farms(current_tile) + ".</popuptext><br>";
      let total_farm_area = "<popuptext>- The total area of all farms was " + get_total_farm_area(current_tile) + " ha.</popuptext><br>";
      let value = "<br><popuptextresult><strong>Therefore, the average farm size in " + get_name(current_tile) + " in 2021 was " + get_value(current_tile) + " ha.</strong></popuptextresult><br>";
      div.innerHTML = title + number_of_farms + total_farm_area + value + detailsButton;
      return div;
    }, {
      className: "foliumpopup"
    }
  );
</script>