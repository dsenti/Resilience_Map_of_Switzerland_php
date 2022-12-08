<?php include("tabs/tab_impermeability.php");
include("map_components/map_head.php");
?>

<script>
  //this is the color of the map!!
  var color = "#a00000";
  min = 0;
  max = 30;

  //creating legend of map
  document.getElementById("legend_max").innerHTML = max + "%";
  document.getElementById("legend_min").innerHTML = min + "%";

  function get_data() {
    //the json files which were generated in create_data
    var raw_data = <?php include('data/data_cantons_impermeability.php'); ?>;
    return JSON.parse(raw_data);
  }

  function get_value(feature) {
    //getting the data
    var data = get_data();
    var indexes = get_indexes();

    //this is the id of the feature (map polygon)
    id = Number(feature.id);
    id += 1;

    //getting the canton name with the id
    canton = indexes["Canton"][id];
    //getting the cantonal soil artificialization (CSA) with the canton name
    value = Number(data["percentage artificially impermeable"]["- " + canton]);
    value = Math.round(value * 100) / 100;

    return value;
  }

  function get_impermeable(feature) {
    //getting the data
    var data = get_data();
    var indexes = get_indexes();

    //this is the id of the feature (map polygon)
    id = Number(feature.id);
    id += 1;

    //getting the canton name with the id
    canton = indexes["Canton"][id];
    //getting the value with the canton name
    value = Number(data[">>10.11 Befestigte Flächen 2013/18"]["- " + canton]) + Number(data[">>10.12 Gebäude 2013/18"]["- " + canton]) + Number(data[">>10.13 Treibhäuser 2013/18"]["- " + canton]) + Number(data[">>10.17 Gemischte Kleinstrukturen 2013/18"]["- " + canton]);
    value = Math.round(value * 100) / 100;

    return value;
  }

  function get_total(feature) {
    //getting the data
    var data = get_data();
    var indexes = get_indexes();

    //this is the id of the feature (map polygon)
    id = Number(feature.id);
    id += 1;

    //getting the canton name with the id
    canton = indexes["Canton"][id];
    //getting the value with the canton name
    value = Number(data["Fläche - Total 2013/18"]["- " + canton]);
    value = Math.round(value * 100) / 100;

    return value;
  }
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
                  <td>${String(get_value(layer.feature)) + "%"}</td>
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
      let value = "<br><popuptext>In 2021 the area which was artificially impermeable was " + get_impermeable(current_tile) + " ha.<br> The total area is " + get_total(current_tile)+ 
      " ha.<br><br><strong>Therefore, " + get_value(current_tile) +
        "% of the total area of " + get_name(current_tile) + " in 2021 was artificially impermeable.</strong></popuptext><br>";
      div.innerHTML = title + value + detailsButton;
      return div;
    }, {
      className: "foliumpopup"
    }
  );
</script>