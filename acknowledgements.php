<?php include("base.php") ?>
<link rel= "stylesheet" type= "text/css" href= "{{ url_for('static',filename='stylesheet.css') }}">
  
<head>    
    <div>
        <h1>Acknowledgements</h1>
    </div>
</head>
<body>
    <p>
        The maps are displayed using <a href="https://leafletjs.com/" target="_blank">leaflet</a> (an open-source JavaScript library for mobile-friendly interactive maps).<br><br>
        
        Data Sources:<br>
        <a href="https://www.bfs.admin.ch/bfs/de/home/statistiken/regionalstatistik/kartengrundlagen/basisgeometrien.html" target="_blank">Maps</a><br>
        <a href="https://www.bfs.admin.ch/asset/en/px-x-0702000000_101" target="_blank">Cantons Average Farm Size</a><br>
        <a href="https://www.bfs.admin.ch/bfs/de/home/statistiken/land-forstwirtschaft/landwirtschaft/strukturen.assetdetail.22644714.html" target="_blank">Districts Average Farm Size</a><br>

    </p>
</body>