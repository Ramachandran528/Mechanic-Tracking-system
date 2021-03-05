<?php
include "login_protected.php";
include "config.php";
$email = $_SESSION["email"];

$sql = "INSERT INTO payment_details(to_email,to_card_name,to_card_number,to_cv,to_expiry_year,amount,payment_status) VALUES('$email',
'{$_POST['c_name']}','{$_POST['c_number']}',{$_POST['c_ccv']},'{$_POST['c_year']}',{$_POST['c_amount']},'pending')";


if (mysqli_query($conn, $sql)) {
    $sql1 = "UPDATE booking_details SET booking_status='request for payment' WHERE booking_id={$_POST['id']}";

    if (mysqli_query($conn, $sql1))
        echo "1";
    else
        echo mysqli_error($conn);
} else
    echo mysqli_error($conn);
