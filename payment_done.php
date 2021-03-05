<?php

include "login_protected.php";
include "config.php";
$email = $_SESSION["email"];



$sql = "UPDATE payment_details 
SET from_email='$email',
    from_card_name='{$_POST['c_name']}',
    from_card_number='{$_POST['c_number']}',
    from_cv='{$_POST['c_ccv']}',
    from_expiry_year='{$_POST['c_year']}'
    WHERE to_email='{$_POST['m_email']}' AND payment_status='pending'
    ";

if (mysqli_query($conn, $sql)) {
    $sql1 = "UPDATE booking_details SET booking_status='paid' WHERE booking_id={$_POST['id']}";

    if (mysqli_query($conn, $sql1))
        echo "1";
    else
        echo mysqli_error($conn);
} else
    echo mysqli_error($conn);
