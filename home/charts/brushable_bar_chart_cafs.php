<?php include("chart_head.php"); ?>

<brushable_bar_chart>

  <div id="title">Average Farm Size - Cantons (in ha)</div>
  <div id="chart"></div>
  <div id="explanation">You can see more or less of the total bar chart on the left by either dragging the box in the mini chart on the right or by scrolling your mouse. You can also click anywhere in the mini chart to center the box on that region. And you can increase and decrease the size of the box by dragging the top or bottom handle up or down.</div>

  <script>
    var data = [],
      svg,
      defs,
      gBrush,
      brush,
      main_xScale,
      mini_xScale,
      main_yScale,
      mini_yScale,
      main_yZoom,
      main_xAxis,
      main_yAxis,
      mini_width,
      textScale;
    var colors = ["#b98fc2", "#9d52ad", "#9d52ad"];
    var min_zoom = 10000;
    var max_zoom = 38;


    function unique() {
      json_data = <?php include("../../data/data_cantons_average_farm_size.php"); ?>;
      json_data = JSON.parse(json_data);
      json_data = json_data["2021 average farm size"];
      i = 0;

      for (var key in json_data) {
        var my_object = {};
        my_object.key = i;
        i++;
        my_object.tile = key;
        my_object.value = json_data[key];
        data.push(my_object);
      }

      
      data.sort(function(a, b) {
        return b.value - a.value;
      });
    }
  </script>
  <?php include("chart_common.php"); ?>