<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans+Condensed:wght@1;400;700&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <link href="carte.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <title>map</title>
</head>
<body>

<?php
$servername = 'localhost';
$username = 'postgres';
$password = 'password';

//try {
////// make a database
//    $dsn = "pgsql:host=localhost;port=5432;dbname=fuel-dataviz;";
//    $pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//    if ($pdo) {
//        echo
//        "Connected to the db database successfully!";
//    }
//} catch
//(PDOException $e) {
//    die($e->getMessage());
//}
?>

<div id="map"></div>

<?php
$dsn = "pgsql:host=localhost;port=5432;dbname=fuel-dataviz;";
$pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$queryMap = $pdo->query(
    "SELECT latitude, longitude FROM point_de_vente
    WHERE ville = 'ANNECY'");

foreach ($queryMap as $data) {
    $latitude[] = $data['latitude'];
    $longitude[] = $data['longitude'];
};

$point = [];
for ($i=0;$i<12;$i++){
    $point[$i] = [$latitude[$i], $longitude[$i]];
};

$queryAdresse = $pdo->query(
    "SELECT adresse FROM point_de_vente
    WHERE ville = 'ANNECY'");

foreach ($queryAdresse as $data) {
    $adresse[] = $data['adresse'];
};

$arayAdresse = [];
for ($a=0;$a<12;$a++){
    $arayAdresse [$a] = [$adresse[$a]];
};


?>

</body>

<script>
    let coords = [];
    coords.push(<?php echo json_encode($point)?>);
    coords = coords[0];
    console.log(coords);

    let adresseMap = [];
    adresseMap.push(<?php echo json_encode($arayAdresse)?>);
    adresseMap = adresseMap[0];
    console.log(adresseMap);

    var map = L.map('map').setView([45.89860986946062, 6.12917203841142], 12);

    var CartoDB_VoyagerLabelsUnder = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);

    //coords = [[45.89856023085219, 6.117736246509577], [45.90706560732963, 6.113352659053238], [45.91763558459165, 6.128630520636682]];
    //areas
    noms = ["Prix carburant", "Prix carburant", "Prix carburant"]
    // rooms
    //
    //prix = ["1.25", "2.89", "5"]
    //outside

    //let l = coords.length;

    for (let i = 0; i < 12; i++) {
        //popus
        var pop = L.popup({
            closeOnClick: true
        }).setContent /* affiche ce mot ('Station essence');*/('<h2>adresse : ' + adresseMap[i] );
        //marqueur

        var marker = L.marker(coords[i]).addTo(map).bindPopup(pop);

        // //labels
        // var toollip = L.tooltip({
        //     permanent: true
        // }).setContent(rent[i]);
        //
        // marker.bindTooltip(toollip);
    }

</script>

</html>