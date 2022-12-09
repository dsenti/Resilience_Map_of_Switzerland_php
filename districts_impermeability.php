<?php include("tabs/tab_impermeability.php");
include("map_components/map_head.php");
?>

<script>
  //this is the color of the map!!
  var color = "#a00000"
  min = 0;
  max = 50;

  //creating legend of map
  document.getElementById("legend_max").innerHTML = max + "%"
  document.getElementById("legend_min").innerHTML = min + "%"

  function get_value(feature){
    return get_impermeability_percentage(feature);
  }

</script>

<?php include("data/getter_functions_districts.php"); ?>;
<?php include("map_components/districts_map_init.php"); ?>;

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
                  <td>${String(get_impermeability_percentage(layer.feature)) + "%"}</td>
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
<!-- defining the iframe as detailsdistricts.html (done in views) -->
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
      let value = "<br><popuptext>In 2021 the area which was artificially impermeable was " + get_impermeable(current_tile) + " ha.<br> The total area is " + get_area(current_tile)+ " ha.<br><br><strong>Therefore, " + get_impermeability_percentage(current_tile) +"% of the total area of " + get_name(current_tile) + " in 2021 was artificially impermeable.</strong></popuptext><br>";
      div.innerHTML = title + value + detailsButton;
      return div;
    }, {
      className: "foliumpopup"
    }
  )
</script>