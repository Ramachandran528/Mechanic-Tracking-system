<?php
include "login_protected.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customer page</title>
    <link rel="stylesheet" href="./css/myaccount.css" />
</head>

<body>
    <div class="container">
        <?php
        include "image_upload.php";
        ?>
        <form action="" id="customer_details_frm" method="post" autocomplete="off">
        </form>
    </div>
    <script src="./jquery/lib/jquery.js"></script>
    <script src="./jquery/dist/jquery.validate.js"></script>
    <script>
        $("document").ready(function() {
            $("#customer_details_frm").load("my_account_customer.php");

            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        url: "update_customer_details.php",
                        type: "post",
                        data: $("#customer_details_frm").serialize(),
                        success: function(data) {
                            if (data == 1) {
                                alert("Data Updated Successfully");
                                $("#customer_details_frm").load(data);
                            } else
                                alert("Unable to update the data");
                        }
                    })
                }
            });

            $.validator.addMethod("password_validator", function(value, element) {
                param = new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/);
                if (param.test(value))
                    return true;
            }, "Invalid password");



            $("#customer_details_frm").validate({
                rules: {
                    c_name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        password_validator: true
                    },
                    c_phone_no: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        digits: true
                    },
                    c_door_no: "required",
                    c_street_name: "required",
                    c_city: "required",
                    c_pincode: {
                        required: true,
                        minlength: 6,
                        maxlength: 6
                    },
                    c_state: "required"
                },

                messages: {
                    c_name: "User name is required",
                    email: {
                        required: "Email is required",
                        email: "Invalid email"
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password should be minimum of 6 characters",
                        password_validator: "Password should contain a lower case ,a upper case and a number"
                    },
                    c_phone_no: {
                        required: "Phone is requried",
                        minlength: "Number should be 10 digits",
                        maxlength: "Number should be 10 digits"
                    },
                    c_door_no: "Door number is requried",
                    c_street_name: "Street name is required",
                    c_city: "City is required",
                    c_pincode: {
                        required: "Pincode is required",
                        minlength: "Pincode must be of 6 digits",
                        maxlength: "Pincode must be of 6 digits"
                    },
                    c_state: "State is required",
                }
            })

        });
    </script>
</body>

</html>