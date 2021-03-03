<?php
include "config.php";
$sql = "INSERT INTO  customer_details(c_name,c_email,c_password,c_phone_no,c_door_no,c_street_name,c_city,c_pincode,c_state,c_vehicle_name,c_vehicle_model,c_vehicle_type) VALUES('{$_POST['c_name']}','{$_POST['email']}','{$_POST['password']}','{$_POST['c_phone_no']}','{$_POST['c_door_no']}','{$_POST['c_street_name']}','{$_POST['c_city']}',{$_POST['c_pincode']},'{$_POST['c_state']}','{$_POST['c_vehicle_name']}','{$_POST['c_vehicle_model']}','{$_POST['c_vehicle_type']}')";
$query_result = mysqli_query($conn, $sql);
$query_result1 = mysqli_query($conn, "INSERT INTO login_details(email,password,role) VALUES('{$_POST['email']}','{$_POST['password']}','customer')");
if ($query_result && $query_result1) {
    session_start();
    $_SESSION["email"] = $_POST['email'];
    echo "1";
} else
    echo mysqli_error($conn);
