<?php
include "config.php";
// echo $_GET['email'];
$m_email = $_GET['email'];
$sql = "SELECT * FROM mechanic_details WHERE m_email='" . $m_email . "'";
$details = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC)[0];
// print_r($details);
$address = $details['m_door_no'] . " " . $details['m_street_name'] . " " . $details['m_area'] . " " . $details['m_city'] . " " . $details['m_pincode'] . " " . $details['m_state'];
echo "<img src='{$details['m_photo']}' width='100'/>
      <p>Name:{$details['m_name']}</p>
      <p>Email:{$details['m_email']}</p>
      <p>Phone no:{$details['m_phone_no']}</p>
      <p>Address:{$address}</p>
      ";
if (!empty($details['m_landmark']))
    echo "<p>Landmark:{$details['m_landmark']}";
echo "<p>Experience:{$details['m_experience']} years</p>
      <p>Opening Time:{$details['m_opening_time']} AM</p>
      <p>Closing Time:{$details['m_closing_time']}PM</p>
      ";
