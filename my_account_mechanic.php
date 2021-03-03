<?php

include "config.php";

session_start();
$email = $_SESSION["email"];

$query_result = mysqli_query($conn, "SELECT * FROM mechanic_details WHERE m_email='$email'");
$query_result = mysqli_fetch_all($query_result, MYSQLI_ASSOC);

echo '  <label>Username</label><br>
        <input type="text" name="m_name" value="' . $query_result[0]['m_name'] . '"><br><br>
        <label>Phone no</label><br>
        <input type="text" name="m_phone_no" value="' . $query_result[0]['m_phone_no'] . '"><br><br>
        <label>Door no</label><br>
        <input type="text" name="m_door_no" value="' . $query_result[0]['m_door_no'] . '"><br><br>
        <label>Street name</label><br>
        <input type="text" name="m_street_name" value="' . $query_result[0]['m_street_name'] . '"><br><br>
        <label>Pincode</label><br>
        <input type="number" name="m_pincode" value="' . $query_result[0]['m_pincode'] . '"><br><br>
        <label>City</label><br>
        <input type="text" name="m_city" value="' . $query_result[0]['m_city'] . '"><br><br>
        <label>State</label><br>
        <input type="text" name="m_state" value="' . $query_result[0]['m_state'] . '"><br><br>
        <label>Landmark</label><br>
        <input type="text" name="m_landmark" value="' . $query_result[0]['m_landmark'] . '"><br><br>
        <label>Experience</label><br>
        <input type="text" name="m_experience" value="' . $query_result[0]['m_experience'] . '"><br><br>
        <label>Opening time</label><br>
        <input type="text" name="m_opening_time" value="' . $query_result[0]['m_opening_time'] . '"><br><br>
        <label>Closing Time</label><br>
        <input type="text" name="m_closing_time" value="' . $query_result[0]['m_closing_time'] . '"><br><br>
        <input type="submit" value="update" id="update_btn">
        ';
