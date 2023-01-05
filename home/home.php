<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?php include("home_base.php") ?>

<head>
    <br>
    <h1>Charts</h1>
</head>


<body>
    <iframe class="chartIframe" id="cafs_chartIframe" src="charts/brushable_bar_chart_cafs.php" title="Chart" frameborder="0" style="display:block;"></iframe>
    <iframe class="chartIframe" id="dafs_chartIframe" src="charts/brushable_bar_chart_dafs.php" title="Chart" frameborder="0" style="display:block;"></iframe>
    <iframe class="chartIframe" id="csar_chartIframe" src="charts/brushable_bar_chart_csar.php" title="Chart" frameborder="0" style="display:block;"></iframe>
    <iframe class="chartIframe" id="dsar_chartIframe" src="charts/brushable_bar_chart_dsar.php" title="Chart" frameborder="0" style="display:block;"></iframe>
    <iframe class="chartIframe" id="cimp_chartIframe" src="charts/brushable_bar_chart_cimp.php" title="Chart" frameborder="0" style="display:block;"></iframe>
    <iframe class="chartIframe" id="dimp_chartIframe" src="charts/brushable_bar_chart_dimp.php" title="Chart" frameborder="0" style="display:block;"></iframe>
    <iframe class="chartIframe" id="corf_chartIframe" src="charts/brushable_bar_chart_corf.php" title="Chart" frameborder="0" style="display:block;"></iframe>
    <iframe class="chartIframe" id="dorf_chartIframe" src="charts/brushable_bar_chart_dorf.php" title="Chart" frameborder="0" style="display:block;"></iframe>
    <iframe class="chartIframe" id="cfar_chartIframe" src="charts/brushable_bar_chart_cfar.php" title="Chart" frameborder="0" style="display:block;"></iframe>
    <iframe class="chartIframe" id="dfar_chartIframe" src="charts/brushable_bar_chart_dfar.php" title="Chart" frameborder="0" style="display:block;"></iframe>


    <!-- https://csslayout.io/nested-dropdowns/ -->
    <ul class="nested-dropdowns">
        <li>
            <div class="dropdownbutton">
                Indicators
            </div>
            <ul class="dropdownlist">
                <li id="first_indicator">
                    <div class="nested-dropdowns__item">
                        Average Farm Size
                    </div>
                    <ul>
                        <li class = "tilescale" id="first_scale_dropdown_item" onclick="show_cafs();">Cantons</li>
                        <li class = "tilescale" id="last_dropdown_item" onclick="show_dafs();">Districts</li>
                    </ul>
                </li>
                <li>
                    <div class="nested-dropdowns__item">
                        Soil Artificialization
                    </div>
                    <ul>
                        <li class = "tilescale" id="first_dropdown_item" onclick="show_csar()">Cantons</li>
                        <li class = "tilescale" id="last_dropdown_item" onclick="show_dsar();">Districts</li>

                    </ul>
                </li>
                <li>
                    <div class="nested-dropdowns__item">
                        Impermeability
                    </div>
                    <ul>
                        <li class = "tilescale" id="first_dropdown_item" onclick="show_cimp()">Cantons</li>
                        <li class = "tilescale" id="last_dropdown_item" onclick="show_dimp();">Districts</li>

                    </ul>
                </li>
                <li>
                    <div class="nested-dropdowns__item">
                        Organic Farming
                    </div>
                    <ul>
                        <li class = "tilescale" id="first_dropdown_item" onclick="show_corf()">Cantons</li>
                        <li class = "tilescale" id="last_dropdown_item" onclick="show_dorf();">Districts</li>

                    </ul>
                </li>
                <li id="last_indicator">
                    <div class="nested-dropdowns__item">
                        Farmers
                    </div>
                    <ul>
                        <li class = "tilescale" id="first_dropdown_item" onclick="show_cfar()">Cantons</li>
                        <li class = "tilescale" id="last_scale_dropdown_item" onclick="show_dfar();">Districts</li>

                    </ul>
                </li>
            </ul>
        </li>
    </ul>

</body>


<script>
    function hide_charts() {
        charts = document.querySelectorAll(".chartIframe");

        charts.forEach(chart => {
            chart.style.display = "none";
        })
    }

    hide_charts();
    document.getElementById("cafs_chartIframe").style.display = "block";


    function show_cafs() {
        hide_charts();
        document.getElementById("cafs_chartIframe").style.display = "block";
    }

    function show_dafs() {
        hide_charts();
        document.getElementById("dafs_chartIframe").style.display = "block";
    }

    function show_csar() {
        hide_charts();
        document.getElementById("csar_chartIframe").style.display = "block";
    }

    function show_dsar() {
        hide_charts();
        document.getElementById("dsar_chartIframe").style.display = "block";
    }

    function show_cimp() {
        hide_charts();
        document.getElementById("cimp_chartIframe").style.display = "block";
    }

    function show_dimp() {
        hide_charts();
        document.getElementById("dimp_chartIframe").style.display = "block";
    }

    function show_corf() {
        hide_charts();
        document.getElementById("corf_chartIframe").style.display = "block";
    }

    function show_dorf() {
        hide_charts();
        document.getElementById("dorf_chartIframe").style.display = "block";
    }
    
    function show_cfar() {
        hide_charts();
        document.getElementById("cfar_chartIframe").style.display = "block";
    }

    function show_dfar() {
        hide_charts();
        document.getElementById("dfar_chartIframe").style.display = "block";
    }
</script>