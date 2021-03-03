<?php
session_start();
$c_email = $_SESSION["email"];

include "config.php";

$sql = "INSERT INTO booking_details(c_email,m_email,booking_address,vehicle_name,vehicle_model,repair_description,booking_time,booking_status) VALUES('$c_email','{$_POST["m_email"]}','{$_POST["booking_address"]}','{$_POST["vehicle_name"]}','{$_POST["vehicle_model"]}','{$_POST["repair_description"]}',now(),'booked')";

if (mysqli_query($conn, $sql))
    echo "1";
else
    echo "0";
