<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"
    <title>Graphique prix moyen carburants</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

<?php
$dsn = 'pgsql:host=localhost;port=5432;dbname=fuel-dataviz;user=postgres;password=password';
$pdo =  new PDO($dsn);

$query = $pdo->query("SELECT AVG(valeur), carburant.nom FROM prix
JOIN carburant ON prix.carburant_id = carburant.id
AND extract(YEAR from date)=2007
GROUP BY carburant.nom");

$query2 = $pdo->query("SELECT AVG(valeur), carburant.nom FROM prix
JOIN carburant ON prix.carburant_id = carburant.id
AND extract(YEAR from date)=2014
GROUP BY carburant.nom");

$query3 = $pdo->query("SELECT AVG(valeur), carburant.nom FROM prix
JOIN carburant ON prix.carburant_id = carburant.id
AND extract(YEAR from date)=2023
GROUP BY carburant.nom");

foreach ($query as $data)
 {
     $avg[]=$data['avg'];
     $extract[]=$data['nom'];
 }
foreach ($query2 as $data)
{
    $avg[]=$data['avg'];
    $extract[]=$data['nom'];
}
foreach ($query3 as $data)
{
    $avg[]=$data['avg'];
    $extract[]=$data['nom'];
}
?>




<div>
    <canvas id="myChart"></canvas>
</div>


<script>
    const ctx = document.getElementById("myChart");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: <?php echo json_encode($extract) ?>,
            datasets: [{
                label: '2007',
                data: <?php echo json_encode($avg)?>,
                borderWidth: 2
            }]
        },
         options: {
             scales: {
                y: {
                    beginAtZero: true
                 }
            }
        }
    });
</script>


</body>


