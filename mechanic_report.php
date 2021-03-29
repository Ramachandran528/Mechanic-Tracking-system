<?php
include "login_protected.php";
include "config.php";

$email = $_SESSION["email"];
$total_bookings = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM booking_details WHERE m_email='$email'"))[0];
$success_bookings = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM booking_details WHERE m_email='$email' and booking_status='paid'"))[0];
$rejected_bookings = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM booking_details WHERE m_email='$email' and booking_status='rejected'"))[0];
echo mysqli_error($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic_report</title>
</head>

<body>
    <?php include "login_header.php" ?>
    <p>Total number of bookings: <?php echo $total_bookings; ?></p>
    <p>Successful bookings: <?php echo $success_bookings; ?></p>
    <p>Rejected bookings: <?php echo $rejected_bookings; ?></p>
</body>

</html>