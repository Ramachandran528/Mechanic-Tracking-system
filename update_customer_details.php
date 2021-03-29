<?php
session_start();

include "config.php";
$email = $_SESSION["email"];
$sql = "UPDATE customer_details 
        SET c_name='{$_POST['c_name']}',
            c_phone_no='{$_POST['c_phone_no']}',
            c_door_no='{$_POST['c_door_no']}',
            c_street_name='{$_POST['c_street_name']}',
            c_pincode={$_POST['c_pincode']},
            c_city='{$_POST['c_city']}',
            c_state='{$_POST['c_state']}',
            c_vehicle_name='{$_POST['c_vehicle_name']}',
            c_vehicle_model='{$_POST['c_vehicle_model']}',
            c_vehicle_type='{$_POST['c_vehicle_type']}'
            WHERE c_email='$email'";
$query_result = mysqli_query($conn, $sql);
if ($query_result)
    echo "1";
else
    echo mysqli_error($conn);
