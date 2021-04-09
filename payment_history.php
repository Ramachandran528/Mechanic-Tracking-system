<?php

include "login_protected.php";
include "login_header.php";
include "config.php";

$email = $_SESSION["email"];
$role = $_SESSION["role"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='./css/payment_history.css' />
</head>

<body>
    <div id="img_container"></div>
    <div class="container">
        <?php
        if ($role == 'customer') {
            $sql = "SELECT * FROM payment_details WHERE from_email='$email' order by payment_time desc";
            $payment_details = mysqli_query($conn, $sql);
            $payment_details = mysqli_fetch_all($payment_details, MYSQLI_ASSOC);

            if (count($payment_details) > 0) {
                echo "<table>
                <tr>
                    <th>Mechanic Email</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
             ";

                foreach ($payment_details as $payment_detail) {
                    echo "<tr>
                        <td>{$payment_detail['to_email']}</td>
                        <td>{$payment_detail['amount']}</td>
                        <td>{$payment_detail['payment_status']}</td>
                     </tr>";
                }
            } else
                echo "<h3>No payments Done</h3>";
        } else {
            $sql = "SELECT * FROM payment_details WHERE to_email='$email' order by payment_time desc";
            $payment_details = mysqli_query($conn, $sql);
            $payment_details = mysqli_fetch_all($payment_details, MYSQLI_ASSOC);

            if (count($payment_details) > 0) {
                echo "<table>
                <tr>
                    <th>Requested user</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
             ";

                foreach ($payment_details as $payment_detail) {
                    echo "<tr>
                        <td>{$payment_detail['from_email']}</td>
                        <td>{$payment_detail['amount']}</td>
                        <td>{$payment_detail['payment_status']}</td>
                     </tr>";
                }
            } else
                echo "<h3>No payments Done</h3>";
        }
        ?>
    </div>
</body>

</html>