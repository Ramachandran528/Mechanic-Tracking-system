<?php
include "login_protected.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic page</title>
    <link rel="stylesheet" href="./css/myaccount.css" />
    <link rel="stylesheet" href="./css/errors.css" />
</head>

<body>
    <div class="container">
        <?php
        include "image_upload.php";
        ?>
        <form id="mechanic_details_frm">
        </form>
    </div>
    <script src="./jquery/lib/jquery.js"></script>
    <script src="./jquery/dist/jquery.validate.js"></script>
    <script>
        $("document").ready(function() {
            $("#mechanic_details_frm").load("my_account_mechanic.php");

            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        url: "update_mechanic_details.php",
                        method: "post",
                        data: $("#mechanic_details_frm").serialize(),
                        success: function(data) {
                            if (data == 1) {
                                alert("Data Updated Successfully");
                                $("#mechanic_details_frm").load("my_account_mechanic.php");
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


            $("#mechanic_details_frm").validate({
                rules: {
                    m_name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    m_password: {
                        required: true,
                        minlength: 6,
                        pattern_validator: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/
                    },
                    m_phone_no: {
                        required: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    m_door_no: {
                        required: true
                    },
                    m_street_name: {
                        required: true
                    },
                    m_city: {
                        required: true
                    },
                    m_pincode: {
                        required: true,
                        minlength: 6,
                        maxlength: 6
                    },
                    m_experience: {
                        required: true,
                        maxlength: 2
                    },
                    m_area: {
                        required: true
                    },
                    m_opening_time: {
                        required: true
                    },
                    m_closing_time: {
                        required: true
                    }
                },
                messages: {
                    m_name: "username is required",
                    email: {
                        required: "An email is required",
                        email: "Invalid email"
                    },
                    m_password: {
                        required: "A password is required",
                        minlength: "password should be minimum of 6 characters",
                        pattern_validator: "Password should contain a lowercase,a uppercase and a digit"
                    },
                    m_phone_no: {
                        required: "Phone number is required",
                        minlength: "Phone number should be of 10 digits",
                        maxlength: "Phone number should be of 10 digits"
                    },
                    m_door_no: {
                        required: "Door number is requried"
                    },
                    m_street_name: {
                        required: "Street name is required"
                    },
                    m_city: {
                        required: "City name is required"
                    },
                    m_pincode: {
                        required: "Pincode is requried",
                        minlength: "Pincode should be of 6 digits",
                        maxlength: "Pincode should be of 6 digits"
                    },
                    m_experience: {
                        required: "Experience is required",
                        maxlength: "Invalid experience"
                    },
                    m_area: {
                        required: "Area is required"
                    },
                    m_opening_time: {
                        required: "Shop opening time is required"
                    },
                    m_closing_time: {
                        required: "Shop closing time is required"
                    }
                }
            });
        });
    </script>
</body>

</html>