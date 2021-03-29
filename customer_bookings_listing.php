<?php

include "login_protected.php";
include "config.php";

$email = $_SESSION["email"];

$booking_details = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM booking_details WHERE c_email='$email' and booking_status!='canceled' ORDER BY booking_time DESC"), MYSQLI_ASSOC);

foreach ($booking_details as $booking_detail) {
  $mechanic_detail = mysqli_query($conn, "SELECT * FROM mechanic_details WHERE m_email='{$booking_detail['m_email']}'");
  $mechanic_detail = mysqli_fetch_all($mechanic_detail, MYSQLI_ASSOC);
  $address = "Door No: {$mechanic_detail[0]['m_door_no']} {$mechanic_detail[0]['m_street_name']} {$mechanic_detail[0]['m_city']} {$mechanic_detail[0]['m_pincode']} {$mechanic_detail[0]['m_state']}";
  echo "<h1>Mechanic details</h1>";
  echo "<div class='mechanic_detalis'>
            <img src={$mechanic_detail[0]['m_photo']} width='100'/>
            <p>Name:{$mechanic_detail[0]['m_name']}</p>
            <p>Email:{$mechanic_detail[0]['m_email']}</p>
            <p>contact:{$mechanic_detail[0]['m_phone_no']}</p>
            <p>Address:{$address}</p>
          </div>
        ";
  echo "<h1>Booking details</h1>";
  echo "<div class='booking_details'>
            <p>Booking address:{$booking_detail['booking_address']}</p>
            <p>vehicle name:{$booking_detail['vehicle_name']}</p>
            <p>vehicle model:{$booking_detail['vehicle_model']}</p>
            <p>repair description:{$booking_detail['repair_description']}</p>
            <p>Status:{$booking_detail['booking_status']}</p>
          </div>
        ";
  if ($booking_detail["booking_status"] == "accepted" || $booking_detail["booking_status"] == "booked")
    echo "<button data-id='{$booking_detail["booking_id"]}' class='cancel-btn' >cancel</button>";
  else if ($booking_detail["booking_status"] == "request for payment")
    echo "<button data-id='{$booking_detail["booking_id"]}' m_email='{$mechanic_detail[0]['m_email']}' class='pay-btn'>Pay</button>";
  echo "<hr/>";
}
