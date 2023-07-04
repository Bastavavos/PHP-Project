<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"
    <title>Graphique prix moyen carburants</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
$dsn = 'pgsql:host=localhost;port=5432;dbname=fuel-dataviz;user=postgres;password=password';
$pdo =  new PDO($dsn);

$query = $pdo->query("SELECT AVG(valeur), carburant.nom, extract(YEAR from date) FROM prix
    JOIN carburant ON prix.carburant_id = carburant.id
    AND extract(YEAR from date)=2007
GROUP BY carburant.nom, extract(year FROM DATE)");

$query2 = $pdo->query("SELECT AVG(valeur), carburant.nom, extract(YEAR from date) FROM prix
    JOIN carburant ON prix.carburant_id = carburant.id
    AND extract(YEAR from date)=2014
GROUP BY carburant.nom, extract(year FROM DATE)");

$query3 = $pdo->query("SELECT AVG(valeur), carburant.nom, extract(YEAR from date) FROM prix
    JOIN carburant ON prix.carburant_id = carburant.id
    AND extract(YEAR from date)=2023
GROUP BY carburant.nom, extract(year FROM DATE)");

foreach ($query as $data)
{
    $avg[]=$data['avg'];
    $extract[]=$data['extract'];

}
foreach ($query2 as $data2)
{
    $avg2[]=$data2['avg'];
    $extract2[]=$data2['extract'];
}
foreach ($query3 as $data3)
{
    $avg3[]=$data3['avg'];
    $extract3[]=$data3['extract'];
    $nom[]=$data3['nom'];
}
?>

<div class="container" style="width: 500px; background-color: #050409;">
<canvas id="barCanvasE10" aria-label="chart" role="img"></canvas>
</div>

<script>
    const barCanvasE10 = document.getElementById("barCanvasE10");
    const barChartE10 = new Chart(barCanvasE10,{
        type:"bar",
        data:{
            labels: <?php echo json_encode($nom)?>,
            datasets:[
                {
                    label: "2007",
                    data: <?php echo json_encode($avg)?>,
                },
                {
                    label: "2014",
                    data:<?php echo json_encode($avg2)?>
                },
                {
                    label: "2023",
                    data:<?php echo json_encode($avg3)?>
                }
            ]
        }
    })
</script>
</body>


