<?php
include "login_protected.php";
include "config.php";
header("Content-type:application/json");
$email = $_SESSION["email"];
$booked = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM booking_details WHERE m_email='$email' and booking_status='booked'"))[0];
$accepted = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM booking_details WHERE m_email='$email' and booking_status='accepted'"))[0];
$rejected_bookings = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM booking_details WHERE m_email='$email' and booking_status='rejected'"))[0];
$request_for_payment = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM booking_details WHERE m_email='$email' and booking_status='request for payment'"))[0];
$paid = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM booking_details WHERE m_email='$email' and booking_status='paid'"))[0];
echo mysqli_error($conn);
echo json_encode([$booked, $accepted, $rejected_bookings, $request_for_payment, $paid]);
