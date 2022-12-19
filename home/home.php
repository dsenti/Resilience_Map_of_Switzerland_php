<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?php include("home_base.php") ?>

<head>
    <h1>Welcome Home</h1>
</head>


<body>
    <iframe class="chartIframe" id="cafs_chartIframe" src="charts/brushable_bar_chart_cafs.php" title="Chart" frameborder="0" style="display:block;"></iframe>
    <iframe class="chartIframe" id="dafs_chartIframe" src="charts/brushable_bar_chart_dafs.php" title="Chart" frameborder="0" style="display:block;"></iframe>
    <iframe class="chartIframe" id="csar_chartIframe" src="charts/brushable_bar_chart_csar.php" title="Chart" frameborder="0" style="display:block;"></iframe>
    <iframe class="chartIframe" id="dsar_chartIframe" src="charts/brushable_bar_chart_dsar.php" title="Chart" frameborder="0" style="display:block;"></iframe>


    <!-- https://csslayout.io/nested-dropdowns/ -->
    <ul class="nested-dropdowns">
        <li>
            <div class="dropdownbutton">
                Indicators
            </div>
            <ul class="dropdownlist">
                <li>
                    <div class="nested-dropdowns__item">
                        Average Farm Size
                    </div>
                    <ul>
                        <li class = "tilescale"><a onclick="show_cafs()">Cantons</a></li>
                        <li class = "tilescale"><a onclick="show_dafs();">Districts</a></li>
                    </ul>
                </li>
                <li>
                    <div class="nested-dropdowns__item">
                        Soil Artificialization
                    </div>
                    <ul>
                        <li class = "tilescale"><a onclick="show_csar()">Cantons</a></li>
                        <li class = "tilescale"><a onclick="show_dsar();">Districts</a></li>

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
</script>