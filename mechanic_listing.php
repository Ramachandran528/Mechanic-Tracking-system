<?php

include "login_protected.php";
include "config.php";
include "login_header.php";

$email = $_SESSION["email"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Lisiting</title>
    <link rel="stylesheet" href="./css/mechanic_listing.css" />
    <link rel="stylesheet" href="./css/errors.css" />
</head>

<body>
    <div id="img_container"></div>
    <form action="" id="search_frm" method="post" autocomplete="off">
        <label>
            <input type="text" name="m_area" value="" placeholder="Area">
        </label>
        <label>
            <input type="number" name="m_experience" value="" placeholder="Experience">
        </label>
        <label>
            <input type="text" name="m_city" value="" placeholder="City">
        </label>
        <input type="button" value="search" id="search_btn">
    </form>
    <div id="container">
        <?php

        $mechanics = mysqli_query($conn, "SELECT * FROM mechanic_details WHERE m_city=(SELECT c_city FROM customer_details WHERE c_email='$email') AND m_email not in (SELECT m_email from booking_details WHERE booking_status='accepted' or booking_status='request for payment' or booking_status='booked')");
        // $mechanics = mysqli_query($conn, "SELECT * FROM mechanic_details WHERE m_city=(SELECT c_city FROM customer_details WHERE c_email='$email')");
        $mechanics = mysqli_fetch_all($mechanics, MYSQLI_ASSOC);
        if (count($mechanics) > 0) {
            foreach ($mechanics as $mechanic) {
                echo "<div class='card'>";
                echo "<div class='card-img'><img src='{$mechanic["m_photo"]}'/></div>";
                $address = "Door No: {$mechanic['m_door_no']} {$mechanic['m_street_name']} {$mechanic['m_area']} {$mechanic['m_city']} {$mechanic['m_pincode']} {$mechanic['m_state']} {$mechanic['m_landmark']} ";
                echo "<div class='card-content'>
                      <p>Name:{$mechanic['m_name']}</p>
                      <p>Email:{$mechanic['m_email']}</p>
                      <p>Contact:{$mechanic['m_phone_no']}</p>
                      <p>Address:{$address}</p>";
                echo  "<p>Experience:{$mechanic['m_experience']} yrs</p>
                      </div>
                      <div class='buttons'>
                        <input type='button' value='book' class='book_btn' data-email='{$mechanic['m_email']}'/>
                      </div>
                      </div>
                     ";
            }
        } else
            echo "
                <div class='no_results_found_container'>
                <img src='images/no_results_found.png'/>
                </div>";
        ?>
    </div>
    <script src="./jquery/lib/jquery.js"></script>
    <script src="./jquery/dist/jquery.validate.js"></script>
    <script>
        $("document").ready(function() {
            $("#search_btn").click(function() {
                $.ajax({
                    url: "search_mechanic.php",
                    data: $("#search_frm").serialize(),
                    type: "post",
                    success: function(data) {
                        console.log(data);
                        $("#container").html(data);
                        $(document).on("click", ".book_btn", function() {
                            var email = $(this).attr("data-email");
                            console.log(email);
                            window.location.href = `mechanic_booking.php?email=${email}`;
                        });
                    }
                })
            })


            // $(document).on("click", ".details_btn", function() {
            //     var email = $(this).attr("data-email");
            //     console.log(email);
            //     window.location.href = `mechanic_details.php?email=${email}`;
            // })

            // $(document).on("click", ".book_btn", function() {
            //     var email = $(this).attr("data-email");
            //     console.log(email);
            //     window.location.href = `mechanic_details.php?email=${email}`;
            // })
        })
    </script>
</body>

</html>