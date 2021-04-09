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
    <link rel="stylesheet" href="./css/login_header.css">
    <style>
        header {
            position: sticky;
            top: 0px;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <a href="#" class="logo">Logo</a>
            <ul class="menus-center">
                <?php
                if ($role == "mechanic") {
                    echo "<li class='menu'><a href='mechanic_booking_details.php'>Bookings</a></li>
                          <li class='menu'><a href='mechanic_report.php'>Mechanic Report</a></li>
                          <li class='menu'><a href='payment_history.php'>Payment history</a></li>
                      </ul>
                     ";
                    $sql = "SELECT m_name,m_photo FROM mechanic_details WHERE m_email='$email'";
                    $query_result = mysqli_fetch_array(mysqli_query($conn, $sql));
                    $name = $query_result[0];
                    $photo = $query_result[1];
                    echo "<ul class='menus-right'>
                    <li class='menu'><a href='mechanic.php' style='margin-right:0.4rem'><img class='profile-image' src='{$photo}'/></a></li>
                    <li class='menu profile-pic'><a href='mechanic.php' style='margin-right:1rem'>{$name}</a></li>
                    <li class='menu'><a href='logout.php'>Logout</a></li>
                    </ul>
                   ";
                } else {
                    echo "
                      <li class='menu'><a href='mechanic_listing.php'>Mechanics</a></li>
                      <li class='menu'><a href='customer_bookings.php'>Bookings</a></li>
                      <li class='menu'><a href='payment_history.php'>Payment history</a></li>
                      </ul>
                     ";
                    $sql = "SELECT c_name,c_photo FROM customer_details WHERE c_email='$email'";
                    $query_result = mysqli_fetch_array(mysqli_query($conn, $sql));
                    $name = $query_result[0];
                    $photo = $query_result[1];
                    echo "<ul class='menus-right'>
                    <li class='menu'><a href='customer.php' style='margin-right:0.4rem'><img class='profile-image' src='{$photo}'/></a></li>
                    <li class='menu profile-pic'><a href='customer.php' style='margin-right:1rem'>{$name}</a></li>
                    <li class='menu'><a href='logout.php'>Logout</a></li>
                    </ul>
                   ";
                }
                ?>
            </ul>
        </nav>
    </header>
</body>

</html>