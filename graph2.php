<?php ?>

<!doctype html>

<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicons/WC.webp">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="HBLZ">
    <title>HBLZ</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="" href="chart.js">

</head>
<body>

<?php
$host = 'localhost';
$dbname = 'fuel-dataviz';
$username = 'postgres';
$password = 'password';

$dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";

try {
    $conn = new PDO($dsn);

    if ($conn) {
        echo "Connecté à $dbname avec succès!";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}



$query02 = $conn->query("SELECT AVG(valeur), extract(YEAR from date) FROM prix
                                JOIN carburant ON prix.carburant_id = carburant.id
                                AND(extract(YEAR from date)=2007
                                OR extract(YEAR from date)=2014
                                OR extract(YEAR from date)=2023)
                                GROUP BY extract(YEAR from date)");
//$result = $conn->prepare($query02);
//
//$result->execute();
//$res = $result->fetchAll();
foreach ($query02 as $data2)
{
    $avg02[]=$data2['avg'];
    $extract02[]=$data2['extract'];
}


?>

<div>
    <canvas id="chap"></canvas>
<!--    <button id="btn-2007" onclick="updateYear('2007')">2007</button>-->
<!--    <button id="btn-2013" onclick="updateYear('2014')">2014</button>-->
<!--    <button id="btn-2023" onclick="updateYear('2023')">2023</button>-->
</div>

<!--    const updateYear = (year) => {-->
<!--    const urlParams = new URLSearchParams(window.location.search);-->
<!--    urlParams.set('year', year);-->
<!--    window.location.search = urlParams.toString();-->
}

<script>
    // const labels = [
    //     '2007',
    //     '2014',
    //     '2023',
    // ];
    // const data = {
    //     labels: labels,
    //     dataset: [{
    //         labels: 'Prix',
    //         borderWidth: 3,
    //         data: [0, 1.18, 1.38, 1.77]
    //     }]
    // };
    // const config = {
    //     type: 'line',
    //     data: data,
    //     options: {}
    // };
    // var myChart = new Chart(document.getElementById('myChart'),config
    // );
    const id = document.getElementById("chap");
    const label = <?php echo json_encode($extract02)?>;
    const chart = new Chart(id, {
        type: "line",
        data: {
            labels: <?php echo json_encode($extract02)?>,
            datasets: [{
                label: "Prix",
                borderWidth: 5,
                data: <?php echo json_encode($avg02)?>,
            }]
        }
    });
    //const barCanvas = document.getElementById("barCanvas");
    //// const moy2007= <?php //echo("140");?>
    //const barChart = new Chart(barCanvas,{
    //    type:"bar",
    //    data:{
    //        labels:["2007","2014","2023"],
    //        datasets:[{
    //            data: [ 120,120,120],
    //        }]
    //    }
    //})
</script>
</body>

</html>