<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>MAP HBLZ</title>

    <style>
        html,
        body,
        #viewDiv {
            padding: 0;
            margin: 0;
            height: 100%;
            width: 100%;
        }
    </style>

    <link rel="stylesheet" href="https://js.arcgis.com/4.18/esri/themes/light/main.css">
    <script src="https://js.arcgis.com/4.18/"></script>
<body>
<script>

    require (["esri/config","esri/Map","esri/views/MapView"],
        function(esriConfig,Map,MapView)
        {
            esriConfig.apiKey = "AAPK3f8377a6b0ae49539c5a95223377fbfaEsELNnhZ6Qd0G3m8d26kcm9L3vGEWHlhRKFEEfQaAaTnCgXR8viG12yIxwqX04oc";//"YOUR-API-KEY";
            let map1 = new Map({basemap:"arcgis-streets-night"})
            let mapview = new MapView({container: "carte", map: map1,
                center: [6.127072976148169, 45.90033703500562],
                zoom: 12});
        })

</script>


<div id = 'carte' style = 'width:50%;height:50%'></div>
</body>
</html>