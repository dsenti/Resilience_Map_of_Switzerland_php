<?php include("chart_head.php"); ?>

<brushable_bar_chart>

  <div id="title">Rate of Soil Artificialization - Cantons (in %)</div>
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

    // var colors = ["#EFB605", "#E9A501", "#E48405", "#E34914", "#DE0D2B", "#CF003E", "#B90050", "#A30F65", "#8E297E", "#724097", "#4F54A8", "#296DA4", "#0C8B8C", "#0DA471", "#39B15E", "#7EB852"];
    var colors = ["#8494ba","#0033a9","#0033a9"];
    var min_zoom = 10000;
    var max_zoom = 38;
  function unique(){

      json_data = <?php include("../../data/data_cantons_artificialization.php"); ?>;
      json_data = JSON.parse(json_data);
      json_data = json_data["increase in artificial land"];

      i = 0;

      for (var key in json_data) {
        var my_object = {};
        my_object.key = i;
        i++;
        my_object.tile = key.slice(1,key.length);
        my_object.value = json_data[key];
        data.push(my_object);
      } 
      

      data.sort(function(a, b) {
        return b.value - a.value;
      });}
</script>
<?php include("chart_common.php") ?>