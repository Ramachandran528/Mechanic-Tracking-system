<?php

include "login_protected.php";
include "config.php";
$email = $_SESSION["email"];
$mechanic_details = mysqli_fetch_array(mysqli_query($conn, "SELECT c_vehicle_name,c_vehicle_model,c_vehicle_type,concat(c_door_no,c_street_name,c_city,c_state) as address FROM customer_details WHERE c_email='$email'"), MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking page</title>
    <link rel="stylesheet" href="./css/login.css" />
    <link rel="stylesheet" href="./css/mechanic_booking.css" />
    <link rel="stylesheet" href="./css/errors.css" />
</head>

<body>
    <form id="booking_frm">
        <label>Booknig address</label><br>
        <input type="text" name="booking_address" id="booking_address" value="<?php echo $mechanic_details['address'] ?>"><br><br>
        <label>Vehicle Name</label><br>
        <input type="text" name="vehicle_name" id="vehicle_name" value="<?php if (!empty($mechanic_details['c_vehicle_name'])) echo $mechanic_details['c_vehicle_name'] ?>"><br><br>
        <label>Vehicle model</label><br>
        <input type="text" name="vehicle_model" id="vehicle_model" value="<?php if (!empty($mechanic_details['c_vehicle_model'])) echo $mechanic_details['c_vehicle_model'] ?>"><br><br>
        <label>Vehicle type</label>
        <select name="vehicle_type" id="vehicle_type">
            <?php
            if ($mechanic_details['c_vehicle_type'] == "")
                echo "
                <option value='' selected>--none--</option>
                <option value='two wheeler'>Two wheeler</option>
                <option value='four wheeler'>Four wheeler</option>";

            else if ($mechanic_details['c_vehicle_type'] == "two wheeler")
                echo "
                <option value=''>--none--</option>
                <option value='two wheeler' selected>Two wheeler</option>
                <option value='four wheeler'>Four wheeler</option>";

            else if ($mechanic_details['c_vehicle_type'] == "four wheeler")
                echo "
                <option value=''>--none--</option>
                <option value='two wheeler'>Two wheeler</option>
                <option value='four wheeler' selected>Four wheeler</option>";
            ?>
        </select><br><br>
        <label>Repair description</label><br>
        <textarea name="repair_description" cols="30" rows="10" id="repair_description"></textarea><br><br>
        <input type="submit" name="book_btn" value="book">
    </form>
    <script src="jquery/lib/jquery.js"></script>
    <script src="jquery/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            var url = window.location.href;
            url = url.split("/");
            m_email = url[url.length - 1].split("=");
            m_email = m_email[1];

            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        url: "insert_booking.php",
                        data: {
                            booking_address: $("#booking_address").val(),
                            vehicle_name: $("#vehicle_name").val(),
                            vehicle_model: $("#vehicle_model").val(),
                            vehicle_type: $("#vehicle_type").val(),
                            repair_description: $("#repair_description").val(),
                            m_email: m_email
                        },
                        method: "post",
                        success: function(data) {
                            if (data == 1)
                                window.location.href = "customer_bookings.php";
                            else
                                alert("Unable to book the mechanic");
                        }
                    })
                }
            });

            $("#booking_frm").validate({
                rules: {
                    booking_address: "required",
                    vehicle_name: "required",
                    vehicle_model: "required",
                    vehicle_type: "required",
                    repair_description: "required"
                },
                messages: {
                    booking_address: "booking address is required",
                    vehicle_name: "vehicle name is required",
                    vehicle_model: "vehicle model is requried",
                    vehicle_type: "vehicle type is required",
                    repair_description: "repair desctription is required"
                }
            })
        })
    </script>
</body>

</html>