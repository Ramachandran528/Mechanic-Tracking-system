<?php
include "login_protected.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic_report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <style>
        .container {
            width: 60%;
            height: auto;
            margin: 1rem auto;
        }

        #myChart {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <?php include "login_header.php" ?>
    <div class="container">
        <canvas id="myChart"></canvas>
    </div>
    <script src="jquery/lib/jquery.js"></script>
    <script src="js/pie_chart.js"></script>
    <script src="js/color_generator.js"></script>
</body>

</html>