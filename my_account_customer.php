<?php
include "config.php";
session_start();
$email = $_SESSION['email'];
$query_result = mysqli_query($conn, "SELECT * FROM customer_details WHERE c_email='$email'");
$query_result = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
echo '  <label>Username</label><br>
        <input type="text" name="c_name" value="' . $query_result[0]['c_name'] . '"><br><br/>
        <label>Phone no</label><br>
        <input type="text" name="c_phone_no" value="' . $query_result[0]['c_phone_no'] . '"><br><br>
        <label>Door no</label><br>
        <input type="text" name="c_door_no" value="' . $query_result[0]['c_door_no'] . '"><br><br>
        <label>Street name</label><br>
        <input type="text" name="c_street_name" value="' . $query_result[0]['c_street_name'] . '"><br><br>
        <label>Pincode</label><br>
        <input type="number" name="c_pincode" value="' . $query_result[0]['c_pincode'] . '"><br><br>
        <label>City</label><br>
        <input type="text" name="c_city" value="' . $query_result[0]['c_city'] . '"><br><br>
        <label>State</label><br>
        <input type="text" name="c_state" value="' . $query_result[0]['c_state'] . '"><br><br>
        <label>Vehicle name</label><br>
        <input type="text" name="c_vehicle_name" value="' . $query_result[0]['c_vehicle_name'] . '"><br><br>
        <label>Vehicle model</label><br>
        <input type="text" name="c_vehicle_model" value="' . $query_result[0]['c_vehicle_model'] . '"><br><br>
        <label>Vehicle Type</label>';
if ($query_result[0]['c_vehicle_type'] == "two wheeler") {
        echo  '<select name="c_vehicle_type" value="' . $query_result[0]['c_vehicle_type'] . '" id="vehicle_type"">
            <option value="two wheeler" selected>Two wheeler</option>
            <option value="four wheeler">Four wheeler</option>
        </select><br><br>';
} else {
        echo  '<select name="c_vehicle_type" value="' . $query_result[0]['c_vehicle_type'] . '" id="vehicle_type"">
            <option value="two wheeler">Two wheeler</option>
            <option value="four wheeler" selected>Four wheeler</option>
        </select><br><br>';
}

echo '<input type="submit" value="update" id="update_btn">';
