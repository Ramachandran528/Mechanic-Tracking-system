<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer signup</title>
    <link rel="stylesheet" href="./css/signup.css" />
    <link rel="stylesheet" href="./css/errors.css" />
    <style>
        .form-container {
            width: 80%;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1 class="heading">Sign up</h1>
        <form action="" id="signup_frm">
            <label>username <br>
                <input type="text" name="m_name"></label><br>
            <label>Email <br>
                <input type="email" name="email">
                <label id="custom-error"></label></label><br>
            <label>Password <br>
                <input type="password" name="m_password"></label><br>
            <label>Phone no <br>
                <input type="text" name="m_phone_no"></label><br>
            <label>Door no <br>
                <input type="text" name="m_door_no"></label><br>
            <label>Street Name <br>
                <input type="text" name="m_street_name"></label><br>
            <label>city <br>
                <input type="text" name="m_city"></label><br>
            <label>Pincode <br>
                <input type="number" name="m_pincode"></label><br>
            <label>Landmark <br>
                <input type="text" name="m_landmark"></label><br>
            <label>State <br>
                <input type="text" name="m_state"></label><br>
            <label>Experience <br>
                <input type="number" name="m_experience"></label><br>
            <label>Opening Time <br>
                <input type="number" name="m_opening_time"></label><br>
            <label>Closing Time <br>
                <input type="number" name="m_closing_time"></label><br>
            <label>State <br>
                <input type="text" name="m_state"></label><br>
            <input type="submit" name="sign up" value="sign up"><br><br>
        </form>
        <p class="footer">Already Have an account <a href="login.php">login</a></p>
    </div>
    <script src="./jquery/lib/jquery.js"></script>
    <script src="./jquery/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $("#custom-error").hide();
            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        url: "user_exists.php",
                        method: "post",
                        data: $("#signup_frm").serialize(),
                        success: function(data) {
                            if (data != -1) {
                                $("#custom-error").text("An user with this email already exists");
                                $("#custom-error").show();
                            } else {
                                $.post("insert_details_mechanic.php", $("#signup_frm").serialize(), function(data) {
                                    if (data == 1)
                                        window.location.href = "mechanic.php";
                                    else
                                        alert("Not inserted");
                                })
                            }
                        }
                    })
                }
            });


            $.validator.addMethod("pattern_validator", function(value, element, regEx) {
                param = new RegExp(regEx);
                if (param.test(value))
                    return true;
            }, "Invalid Entry");

            $("#signup_frm").validate({
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
                    m_opening_time: {
                        required: "Shop opening time is required"
                    },
                    m_closing_time: {
                        required: "Shop closing time is required"
                    }
                }
            })
        });
    </script>
</body>

</html>