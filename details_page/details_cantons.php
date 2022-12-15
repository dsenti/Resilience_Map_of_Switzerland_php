<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="/../static/style.php">
<script src="https://cdn.anychart.com/releases/v8/js/anychart-core.min.js"></script>
<script src="https://cdn.anychart.com/releases/v8/js/anychart-cartesian.min.js"></script>

<head>
    <detailsTitle id="title"> Title </detailsTitle>
</head>



<iframebody>
    <br>
    <strong>Average farm size: </strong><br>
    <div class="chart vertical">
        <div class="afs_chart">
            <div class="grid">
                <div class="bar" id="bar_afs" style="--bar-value:85%;" data-name=""> Error</div>
                <div class="bar stats" id="bar_afs_mean" style="--bar-value:53.19%;" data-name=""> 22.3 ha (mean)</div>
                <div class="bar stats" id="bar_afs_median" style="--bar-value:47.38%;" data-name=""> 19.9 ha (median)</div>
            </div>
        </div>
    </div>
    <br>
    Rate of soil artificialization: <details_stat id="soil_art">x</details_stat>%.<br>
    Percentage of artificially impermeable area: <details_stat id="imp">x</details_stat>%.<br>
    Percentage of Organic Farming: <details_stat id="orfa">x</details_stat>%.<br>
    Percentage of population active in agriculture: <details_stat id="farmers">x</details_stat>%.<br>
    <br>

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
            soil_art = document.getElementById("soil_art")
            soil_art.innerHTML = window.parent.get_soil_artificialization(Canton);
            imp = document.getElementById("imp")
            imp.innerHTML = window.parent.get_impermeability_percentage(Canton);
            orfa = document.getElementById("orfa")
            orfa.innerHTML = window.parent.get_organic_farming_percentage(Canton);
            farmers = document.getElementById("farmers")
            farmers.innerHTML = window.parent.get_farmer_percentage(Canton);

            //adjusting the barcharts for Average Farm Size
            afs_bar = document.getElementById("bar_afs");
            afs_bar_width = (window.parent.get_average_farm_size(Canton) / window.parent.get_farm_size_max()) * 100;
            afs_bar.style = "--bar-value:" + afs_bar_width + "%;";
            afs_bar.innerHTML = " " + window.parent.get_average_farm_size(Canton) + " ha";
            afs_bar.style.backgroundColor = "#9d52ad" + transparency_to_hex(afs_bar_width);
            console.log(afs_bar.style.backgroundColor)

        }

    }

    function transparency_to_hex(transparency) {
        if (transparency > 90) {
            return "FF";
        } else if (transparency > 80) {
            return "E6";
        } else if (transparency > 70) {
            return "CC";
        } else if (transparency > 60) {
            return "B3";
        } else if (transparency > 50) {
            return "99";
        } else if (transparency > 40) {
            return "80";
        } else if (transparency > 30) {
            return "66";
        } else if (transparency > 20) {
            return "4D";
        } else if (transparency > 10) {
            return "33";
        } else {
            return "1A";
        }
    }

    init();
</script>