<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="/../static/style.php">
<script src="https://cdn.anychart.com/releases/v8/js/anychart-core.min.js"></script>
<script src="https://cdn.anychart.com/releases/v8/js/anychart-cartesian.min.js"></script>

<head>
    <detailsTitle id="title"> Title </detailsTitle>
</head>

<iframebody>
    Average farm size: <details_stat id="cafs">x</details_stat> ha.<br>
    Rate of soil artificialization: <details_stat id="soil_art">x</details_stat>%.<br>
    Percentage of artificially impermeable area: <details_stat id="imp">x</details_stat>%.<br>
    Percentage of Organic Farming: <details_stat id="orfa">x</details_stat>%.<br>
    Percentage of population active in agriculture: <details_stat id="farmers">x</details_stat>%.<br>
    <chart id="chart"></chart>

</iframebody>
<script>
    // this function is called when the file reloads and calls a method in the parent file which returns the current tile object
    function init() {
        if (window.parent.getCurrentTile()) { //making sure it is defined to escape error
            var Canton = window.parent.getCurrentTile();
            //we then set the document title to the corresponding name of the canton using the get_name function of the map file
            title = document.getElementById("title")
            title.innerHTML = window.parent.get_name(Canton);
            //getting the indicators of the current tile
            cafs = document.getElementById("cafs")
            cafs.innerHTML = window.parent.get_average_farm_size(Canton);
            soil_art = document.getElementById("soil_art")
            soil_art.innerHTML = window.parent.get_soil_artificialization(Canton);
            imp = document.getElementById("imp")
            imp.innerHTML = window.parent.get_impermeability_percentage(Canton);
            orfa = document.getElementById("orfa")
            orfa.innerHTML = window.parent.get_organic_farming_percentage(Canton);
            farmers = document.getElementById("farmers")
            farmers.innerHTML = window.parent.get_farmer_percentage(Canton);

        }

    }
    init();
</script>



