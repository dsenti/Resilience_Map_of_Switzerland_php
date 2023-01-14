<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="/../static/style.php">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>



<head>

    <img src="../static/back.png" alt="expand" class = "detailsicon" onclick="window.parent.hideDetails()">
    <img src="../static/expand.png" alt="expand" class = "detailsicon expand" onclick="expand()">
    <detailsTitle id="detailstitle"> Title </detailsTitle>
</head>



<iframebody id="iframebody">
    <!-- title of the bar chart -->
    <div class="chart vertical">
        <div class="charttitle">Average Farm Size</div>
        <div class="charttext">This indicator calculates the average farm size of the region.</div>
        <div class="d_afs_chart">
            <div class="grid">
                <!-- the bar which shows the actual value (more height than bar stats, style and data-name are overwritten) -->
                <div class="bar" id="bar_afs" style="--bar-value:100%;" data-name=""> Error</div>
                <!-- the two bars which represent the stats bars, mean and median are taken from data analysis, bar-value is calculated by mean/max*100 -->
                <div class="bar stats" id="bar_afs_mean" style="--bar-value:42.52%;" data-name=""> 22.3 ha (mean)</div>
                <!-- <div class="bar stats" id="bar_afs_median" style="--bar-value:39.9%;" data-name=""> 20.94 ha (median)</div> -->
            </div>
        </div>
    </div>
    <div class="chart vertical" id="sar_chart">
        <div class="charttitle">Rate of Soil Artificialization:</div>
        <div class="charttext">This indicator calculates how much of the total area of the region has seen a change from natural habitats to some kind of artificial soil use between 2009 and 2018.</div>
        <div class="d_sar_chart">
            <div class="grid">
                <div class="bar" id="bar_sar" style="--bar-value:100%;" data-name=""> Error</div>
                <div class="bar stats" id="bar_sar_mean" style="--bar-value:22.47%;" data-name=""> 0.72% (mean)</div>
                <!-- <div class="bar stats" id="bar_sar_median" style="--bar-value:21.32%;" data-name=""> 0.68% (median)</div> -->
            </div>
        </div>
    </div>
    <div class="chart vertical" id="imp_chart">
        <div class="charttitle">Percentage of Artificially Impermeable Area</div>
        <div class="charttext">This indicator calculates the area which has been rendered artificially impermeable (not allowing water to pass through) as a percentage of the total area of the region.
            This includes buildings, roads etc but doesn't include naturally impermeable surfaces such as rock.</div>
        <div class="d_imp_chart">
            <div class="grid">
                <div class="bar" id="bar_imp" style="--bar-value:100%;" data-name=""> Error</div>
                <div class="bar stats" id="bar_imp_mean" style="--bar-value:19.41%;" data-name=""> 9.6% (mean)</div>
                <!-- <div class="bar stats" id="bar_imp_median" style="--bar-value:15.33%;" data-name=""> 7.6% (median)</div> -->
            </div>
        </div>
    </div>
    <div class="chart vertical" id="orf_chart">
        <div class="charttitle">Percentage of Organic Farming</div>
        <div class="charttext">This indicator calculates the percentage of farmland which is used as organic farming.</div>
        <div class="d_orf_chart">
            <div class="grid">
                <div class="bar" id="bar_orf" style="--bar-value:100%;" data-name=""> Error</div>
                <div class="bar stats" id="bar_orf_mean" style="--bar-value:25.25%;" data-name=""> 20.96% (mean)</div>
                <!-- <div class="bar stats" id="bar_orf_median" style="--bar-value:26.00%;" data-name=""> 18.59% (median)</div> -->
            </div>
        </div>
    </div>
    <div class="chart vertical" id="far_chart">
        <div class="charttitle">Percentage of Population Active in Agriculture:</div>
        <div class="charttext">This indicator calculates the percentage of the population of the region, which works in the agricultural sector.</div>
        <div class="d_far_chart">
            <div class="grid">
                <div class="bar" id="bar_far" style="--bar-value:100%;" data-name=""> Error</div>
                <div class="bar stats" id="bar_far_mean" style="--bar-value:25.63%;" data-name=""> 2.69% (mean)</div>
                <!-- <div class="bar stats" id="bar_far_median" style="--bar-value:20.71%;" data-name=""> 2.1.8% (median)</div> -->
            </div>
        </div>
    </div>

</iframebody>




<script>
    // this function is called when the file reloads and calls a method in the parent file which returns the current tile object
    function init() {
        if (window.parent.getCurrentTile()) { //making sure it is defined to escape error
            var District = window.parent.getCurrentTile();
            //we then set the document title to the corresponding name of the District using the get_name function of the map file
            title = document.getElementById("detailstitle")
            title.innerHTML = window.parent.get_name(District);

            //adjusting the barcharts for Average Farm Size
            afs_bar = document.getElementById("bar_afs");
            afs_bar_width = (window.parent.get_average_farm_size(District) / window.parent.get_farm_size_max()) * 100;
            afs_bar.style = "--bar-value:" + afs_bar_width + "%;";
            afs_bar.innerHTML = " " + window.parent.get_average_farm_size(District) + " ha";
            afs_bar.style.backgroundColor = "#9d52ad" + transparency_to_hex(afs_bar_width);
            //adjusting the barcharts for Soil Artificialization
            sar_bar = document.getElementById("bar_sar");
            sar_bar_width = (window.parent.get_soil_artificialization(District) / window.parent.get_soil_artificialization_max()) * 100;
            sar_bar.style = "--bar-value:" + sar_bar_width + "%;";
            sar_bar.innerHTML = " " + window.parent.get_soil_artificialization(District) + " %";
            sar_bar.style.backgroundColor = "#0033a9" + transparency_to_hex(sar_bar_width);
            //adjusting the barcharts for Impermeability
            imp_bar = document.getElementById("bar_imp");
            imp_bar_width = (window.parent.get_impermeability_percentage(District) / window.parent.get_impermeability_percentage_max()) * 100;
            imp_bar.style = "--bar-value:" + imp_bar_width + "%;";
            imp_bar.innerHTML = " " + window.parent.get_impermeability_percentage(District) + " %";
            imp_bar.style.backgroundColor = "#a00000" + transparency_to_hex(imp_bar_width + 10);
            //adjusting the barcharts for Organic Farming
            orf_bar = document.getElementById("bar_orf");
            orf_bar_width = (window.parent.get_organic_farming_percentage(District) / window.parent.get_organic_farming_percentage_max()) * 100;
            orf_bar.style = "--bar-value:" + orf_bar_width + "%;";
            orf_bar.innerHTML = " " + window.parent.get_organic_farming_percentage(District) + " %";
            orf_bar.style.backgroundColor = "#00570e" + transparency_to_hex(orf_bar_width + 10);
            //adjusting the barcharts for Farmers
            far_bar = document.getElementById("bar_far");
            far_bar_width = (window.parent.get_farmer_percentage(District) / window.parent.get_farmer_percentage_max()) * 100;
            far_bar.style = "--bar-value:" + far_bar_width + "%;";
            far_bar.innerHTML = " " + window.parent.get_farmer_percentage(District) + " %";
            far_bar.style.backgroundColor = "#247D68" + transparency_to_hex(far_bar_width + 10);

            //positioning barchart of current tab at the top
            if (String(window.parent.location.href).endsWith("average_farm_size.php")) {
                $('#afs_chart').prependTo('#iframebody')
            } else if (String(window.parent.location.href).endsWith("soil_artificialization.php")) {
                $('#sar_chart').prependTo('#iframebody')
            } else if (String(window.parent.location.href).endsWith("impermeability.php")) {
                $('#imp_chart').prependTo('#iframebody')
            } else if (String(window.parent.location.href).endsWith("organic_farming.php")) {
                $('#orf_chart').prependTo('#iframebody')
            } else if (String(window.parent.location.href).endsWith("farmers.php")) {
                $('#far_chart').prependTo('#iframebody')
            }

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

<button id="iframebackbutton" onclick="window.parent.hideDetails()">close</button>

<script>
    // source for rgb2hex function: http://wowmotty.blogspot.com/2017/05/convert-rgba-output-to-hex-color.html
    function rgb2hex(orig) {
        var a, isPercent,
            rgb = orig.replace(/\s/g, '').match(/^rgba?\((\d+),(\d+),(\d+),?([^,\s)]+)?/i),
            alpha = (rgb && rgb[4] || "").trim(),
            hex = rgb ? "#" +
            (rgb[1] | 1 << 8).toString(16).slice(1) +
            (rgb[2] | 1 << 8).toString(16).slice(1) +
            (rgb[3] | 1 << 8).toString(16).slice(1) : orig;
        if (alpha !== "") {
            isPercent = alpha.indexOf("%") > -1;
            a = parseFloat(alpha);
            if (!isPercent && a >= 0 && a <= 1) {
                a = Math.round(255 * a);
            } else if (isPercent && a >= 0 && a <= 100) {
                a = Math.round(255 * a / 100)
            } else {
                a = "";
            }
        }
        if (a) {
            hex += (a | 1 << 8).toString(16).slice(1);
        }
        return hex;
    }

    //changes the opacity of the backgroundcolor of the element passed to the percentage (rounded up to the neares multiple of ten)
    function changeopacity(element, percentage) {
        var bgcolor = element.style.backgroundColor;
        bgcolor = rgb2hex(bgcolor);
        element.style.backgroundColor = String(bgcolor).slice(0, 7) + String(transparency_to_hex(percentage));
    }

    //changes the opacity of the background color to 100% when you hover over the bar
    var hoverfunction = function() {
        changeopacity(this, 100);
    }

    //changes the opacity back to what it was when the mouse doesn't hover anymore
    var endhoverfunction = function() {
        var percentage = this.style.cssText;
        percentage = percentage.slice(13, 16);
        changeopacity(this, percentage);
    }

    //applying the functions defined above to the object eventlisteners
    const bars = document.querySelectorAll('.bar:not(.stats)');
    bars.forEach(bar => {
        bar.addEventListener('mouseover', hoverfunction)
        bar.addEventListener('mouseout', endhoverfunction)
    })
    
    function expand(){
        var frame = window.parent.document.getElementById('detailsIframe');
        frame.style.width="93%";
        frame.style.marginLeft ="1%";
        frame.style.height = "77%"
        var iframebody = document.getElementById('iframebody');
        iframebody.style.display = "inline-grid";
        var expandbutton = document.getElementsByClassName('expand');
        expandbutton[0].style.marginLeft = "94.4%";
        expandbutton[0].src="../static/minimize.png";
        expandbutton[0].setAttribute("onclick", "minimize()")
        // document.getElementById("imageid").src="../template/save.png";
    }

    function minimize(){
        var frame = window.parent.document.getElementById('detailsIframe');
        frame.style.width="35%";
        frame.style.height = "72%"
        frame.style.marginLeft ="59%";
        var iframebody = document.getElementById('iframebody');
        iframebody.style.display = "inline";
        var expandbutton = document.getElementsByClassName('expand');
        expandbutton[0].style.marginLeft = "85%";
        expandbutton[0].src="../static/expand.png";
        expandbutton[0].setAttribute("onclick", "expand()")
    }

    window.onkeydown = function(event) {
        if (event.keyCode == 27) {
            window.parent.hideDetails();
        }
    };
</script>