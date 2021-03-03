<?php
include "config.php";
$sql = "SELECT * FROM login_details WHERE email='{$_POST['email']}'";
$query_result = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
if (count($query_result) >= 1) {
    session_start();
    $_SESSION["email"] = $_POST['email'];
    if ($query_result[0]["role"] == "mechanic")
        echo "mechanic";
    else
        echo "customer";
} else
    echo "-1";
