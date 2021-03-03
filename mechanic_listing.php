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
</head>

<body>
    <form action="" id="search_frm" method="post">
        <label>Pincode</label>
        <input type="text" name="m_pincode" value="">
        <label>Experience</label>
        <input type="number" name="m_experience" value="">
        <label>city</label>
        <input type="text" name="m_city" value="">
        <input type="button" value="search" id="search_btn">
    </form>
    <div id="container">
        <?php
        $mechanics = mysqli_query($conn, "SELECT * FROM mechanic_details WHERE m_city=(SELECT c_city FROM customer_details WHERE c_email='$email')");
        if (mysqli_num_rows($mechanics) > 0) {
            foreach ($mechanics as $mechanic) {
                echo "<div class='card'>";
                echo "<img src='{$mechanic["m_photo"]}' width='100'/>";
                $address = "Door No: {$mechanic['m_door_no']} {$mechanic['m_street_name']} {$mechanic['m_city']} {$mechanic['m_pincode']} {$mechanic['m_state']}";
                echo "<p>Name:{$mechanic['m_name']}</p>
                      <p>Email:{$mechanic['m_email']}</p>
                      <p>Contact:{$mechanic['m_phone_no']}</p>
                      <p>Address:{$address}</p>
                      <p>Landmark:{$mechanic['m_landmark']}</p>
                      <p>Experience:{$mechanic['m_experience']} yrs</p>
                      <p>Opening Time:{$mechanic['m_opening_time']}</p>
                      <p>Closing Time:{$mechanic['m_closing_time']}</p>
                      <input type='button' value='book' class='book_btn' data-email='{$mechanic['m_email']}'/>
                      </div>
                      <hr/>
                     ";
            }
        } else
            echo "No results found";
        ?>
    </div>
    <script src="./jquery/lib/jquery.js"></script>
    <script src="./jquery/dist/jquery.validate.js"></script>
    <script>
        // $.validator.setDefaults({
        //     submitHanlder: function() {
        //         $.post("search_mechanic.php", {
        //             pincode: m_pincode,
        //             experience: m_experience,
        //             city: m_city
        //         }, function(data) {
        //             $("#container").html(data);
        //         })
        //     }
        // });

        // $("document").ready(function() {

        //     $.validator.addMethod("pattern-validator", function(value, element, regEx) {
        //         var param = new regEx(regEx);
        //         if (param.test(value))
        //             return true;
        //     }, "Invalid password");

        //     $("#search_frm").validate({
        //         rules: {
        //             m_pincode: {
        //                 minlength: 6,
        //                 maxlength: 6
        //             },
        //             m_experience: {
        //                 maxlength: 2
        //             }
        //         },
        //         messages: {
        //             m_pincode: {
        //                 minlength: "Pincode should be of 6 digits",
        //                 maxlength: "Pincode should be of 6 digits"
        //             },
        //             m_experience: {
        //                 maxlength: "Invalid Experience"
        //             }
        //         }
        //     })
        // })
        $("document").ready(function() {
            $("#search_btn").click(function() {
                $.ajax({
                    url: "search_mechanic.php",
                    data: $("#search_frm").serialize(),
                    type: "post",
                    success: function(data) {
                        console.log(data);
                        $("#container").html(data);
                        $(".book_btn").on("click", function() {
                            var email = $(this).attr("data-email");
                            console.log(email);
                            window.location.href = `mechanic_booking.php?email=${email}`;
                        });
                    }
                })
            })

            $(".book_btn").on("click", function() {
                var email = $(this).attr("data-email");
                console.log(email);
                window.location.href = `mechanic_booking.php?email=${email}`;
            });
        })
    </script>
</body>

</html>