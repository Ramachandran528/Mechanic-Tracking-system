<?php


// including configuration file
include "config.php";

$email = $_SESSION["email"];
$role = "";
$sql = "SELECT * FROM login_details WHERE email='$email'";
$query_result = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
$role = $query_result[0]["role"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <a href="#" class="logo">Logo</a>
        <ul class="menus">
            <?php
            if ($role == "mechanic") {
                echo "<li class='menu'><a href='mechanic_booking_details.php'>Bookings</a></li>
                      <li class='menu'><a href='#'>My account</a></li>
                     ";
                $sql = "SELECT m_name,m_photo FROM mechanic_details WHERE m_email='$email'";
                $query_result = mysqli_fetch_array(mysqli_query($conn, $sql));
                $name = $query_result[0];
                $photo = $query_result[1];
            } else {
                echo "
                      <li class='menu'><a href='mechanic_listing.php'>Mechanics</a></li>
                      <li class='menu'><a href='customer_bookings.php'>Bookings</a></li>
                      <li class='menu'><a href='customer.php'>My account</a></li>
                     ";
                $sql = "SELECT c_name,c_photo FROM customer_details WHERE c_email='$email'";
                $query_result = mysqli_fetch_array(mysqli_query($conn, $sql));
                $name = $query_result[0];
                $photo = $query_result[1];
            }
            echo "<li class='menu'>{$name}</li>";
            if ($photo == "")
                echo "<li class='menu'><img src='images/default-image.jpg' width='100'/></li>";
            else
                echo "not empty";
            ?>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </header>
</body>

</html>