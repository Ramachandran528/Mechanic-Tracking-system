<?php

session_start();
include "config.php";

$email = $_SESSION["email"];
$role = mysqli_fetch_array(mysqli_query($conn, "SELECT role FROM login_details WHERE email='$email'"))[0];


$filename = $_FILES['file']['name'];
$location = $filename;
$imageFileType = pathinfo($location, PATHINFO_EXTENSION);
$new_location = $role . "_images/" . time() . "." . $imageFileType;


if (move_uploaded_file($_FILES['file']['tmp_name'], $new_location)) {
    if ($role == "mechanic")
        $sql = "UPDATE mechanic_details SET m_photo='$new_location' WHERE m_email='$email'";
    else
        $sql = "UPDATE customer_details SET c_photo='$new_location' WHERE c_email='$email'";

    if (mysqli_query($conn, $sql))
        echo $new_location;
    else
        echo 0;
} else
    echo 0;
