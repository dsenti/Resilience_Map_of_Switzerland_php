<!DOCTYPE html>

<!-- source: https://gist.github.com/nbremer/326fb6de768e85261bfd47aa1f497863 -->
<head>
  <meta charset="utf-8">
  <title>Brushable bar chart - Horizontal - IV</title>

  <!-- Google fonts -->
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>

  <!-- <script src="d3.v3.js"></script> -->
  <script src="//d3js.org/d3.v3.min.js"></script>

  <style>
    brushable_bar_chart {
      font-size: 10px;
      font-family: 'Open Sans', sans-serif;
      font-weight: 400;
      text-align: center;
      position: relative;
    }

    #title {
      font-size: 20px;
      padding-bottom: 10px;
      padding-top: 20px;
      font-weight: 300;
    }

    #explanation {
      font-size: 12px;
      max-width: 620px;
      margin: 0 auto;
      padding-top: 10px;
      color: #ababab;
      font-weight: 300;
    }

    .y.axis line {
      fill: none;
    }

    .x.axis line {
      fill: none;
      stroke: #e0e0e0;
      shape-rendering: crispEdges;
    }

    .axis path {
      display: none;
    }

    .brush .extent {
      fill-opacity: .125;
      shape-rendering: crispEdges;
    }

    .resize {
      display: inline !important;
      /* show when empty */
      fill: #7A7A7A;
      fill-opacity: 1;
      stroke: #7A7A7A;
      stroke-width: 2px;
    }

    .bar {
      /*shape-rendering: crispEdges;*/
    }
  </style>

</head>