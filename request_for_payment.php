<?php
include "login_protected.php";
include "config.php";
$email = $_SESSION["email"];

$sql = "INSERT INTO payment_details(from_email,to_email,to_account_name,to_account_number,to_ifsc_code,amount,payment_status) VALUES('{$_POST['from_email']}','$email',
'{$_POST['c_name']}','{$_POST['a_number']}','{$_POST['a_ifsc_code']}',{$_POST['c_amount']},'pending')";


if (mysqli_query($conn, $sql)) {
    $sql1 = "UPDATE booking_details SET booking_status='request for payment' WHERE booking_id={$_POST['id']}";

    if (mysqli_query($conn, $sql1))
        echo "1";
    else
        echo mysqli_error($conn);
} else
    echo mysqli_error($conn);
