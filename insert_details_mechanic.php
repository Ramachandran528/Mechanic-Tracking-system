<?php
include "config.php";
$sql = "INSERT INTO  mechanic_details(m_name,m_email,m_password,m_phone_no,m_door_no,m_street_name,m_city,m_pincode,m_state,m_experience,m_opening_time,m_closing_time,m_landmark) VALUES('{$_POST['m_name']}','{$_POST['email']}','{$_POST['m_password']}',{$_POST['m_phone_no']},'{$_POST['m_door_no']}','{$_POST['m_street_name']}','{$_POST['m_city']}',{$_POST['m_pincode']},'{$_POST['m_state']}',{$_POST['m_experience']},'{$_POST['m_opening_time']}','{$_POST['m_closing_time']}','{$_POST['m_landmark']}')";
$query_result = mysqli_query($conn, $sql);
$query_result1 = mysqli_query($conn, "INSERT INTO login_details(email,password,role) VALUES('{$_POST['email']}','{$_POST['m_password']}','mechanic')");
if ($query_result && $query_result1) {
    session_start();
    $_SESSION["email"] = $_POST['email'];
    echo "1";
} else
    echo mysqli_error($conn);
