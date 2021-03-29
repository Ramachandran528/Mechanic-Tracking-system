<?php

include "login_protected.php";
include "login_header.php";
include "config.php";

$email = $_SESSION["email"];

$booking_details = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM booking_details WHERE m_email='$email' order by booking_time desc"), MYSQLI_ASSOC);


if (count($booking_details) == 0)
  echo "<h3>No bookings Done";
else {
  echo "<h1>Bookings</h1>";
  foreach ($booking_details as $booking_detail) {
    $customer_detail = mysqli_query($conn, "SELECT * FROM customer_details WHERE c_email='{$booking_detail['c_email']}'");
    $customer_detail = mysqli_fetch_all($customer_detail, MYSQLI_ASSOC);
    $address = "Door No: {$customer_detail[0]['c_door_no']} {$customer_detail[0]['c_street_name']} {$customer_detail[0]['c_city']} {$customer_detail[0]['c_pincode']} {$customer_detail[0]['c_state']}";
    echo "<h1>Customer details</h1>";
    echo "<div class='customer_detalis'>
            <img src={$customer_detail[0]['c_photo']} width='100'/>
            <p>Name:{$customer_detail[0]['c_name']}</p>
            <p>Email:{$customer_detail[0]['c_email']}</p>
            <p>contact:{$customer_detail[0]['c_phone_no']}</p>
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
    if ($booking_detail['booking_status'] == 'booked') {
      echo "<button data-id='{$booking_detail["booking_id"]}' class='accept-btn' >Accept</button>
    <button data-id='{$booking_detail["booking_id"]}' class='reject-btn' >Reject</button>";
    } else if ($booking_detail['booking_status'] == "accepted") {
      echo "<button data-id='{$booking_detail["booking_id"]}' class='request-payment-btn' >request for payment</button>";
    }
    echo "<hr/>";
  }
}
