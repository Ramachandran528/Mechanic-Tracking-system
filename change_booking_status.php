<?php
include "config.php";
$query_result = mysqli_query($conn, "UPDATE booking_details SET booking_status='{$_POST['booking_data']}' WHERE booking_id={$_POST['booking_id']}");
if ($query_result)
    echo 1;
else
    echo mysqli_error($conn);
