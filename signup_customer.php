<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/errors.css" />
    <link rel="stylesheet" href="./css/signup.css" />
</head>

<body>
    <div class="form-container">
        <h1 class="heading">Sign up</h1>
        <form action="" id="signup_frm" autocomplete="off">
            <label>Username<br>
                <input type="text" name="c_name"></label>
            <label>Email<br>
                <input type="email" name="email">
                <label id="custom-error"></label></label>
            <label>password<br>
                <input type="password" name="password"></label>
            <label>Phone no <br>
                <input type="text" name="c_phone_no"></label>
            <label>Door no <br>
                <input type="text" name="c_door_no"></label>
            <label>Street name <br>
                <input type="text" name="c_street_name"></label>
            <label>Pincode <br>
                <input type="number" name="c_pincode"></label>
            <label>City <br>
                <input type="text" name="c_city"></label>
            <label>State <br>
                <input type="text" name="c_state"></label>
            <label>Vehicle name <br>
                <input type="text" name="c_vehicle_name"></label>
            <label>Vehicle model <br>
                <input type="text" name="c_vehicle_model"></label>
            <label>Vehicle Type <br>
                <select name="c_vehicle_type">
                    <option value="two wheeler">Two wheeler</option>
                    <option value="four wheeler">Four wheeler</option>
                </select><br><br></label>
            <input type="submit" value="sign up">
        </form>
        <p class="footer">Already Have an account <a href="login.php">login</a></p>
    </div>
    <script src="./jquery/lib/jquery.js"></script>
    <script src="./jquery/dist/jquery.validate.js"></script>
    <script>
        $("document").ready(function() {
            $("#custom-error").hide();
            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        url: "user_exists.php",
                        method: "post",
                        data: $("#signup_frm").serialize(),
                        success: function(data) {
                            if (data != -1) {
                                $("#custom-error").show();
                                $("#custom-error").text("An user with this email already exists");
                            } else {
                                $.post("insert_details_customer.php", $("#signup_frm").serialize(), function(data) {
                                    if (data == 1)
                                        window.location.href = "mechanic_listing.php";
                                    else
                                        alert(data);
                                });
                            }
                        }
                    })
                    // alert("submitted");
                }
            });


            $.validator.addMethod("regex_validator", function(value, element, params) {
                param = new RegExp(params);
                if (param.test(value))
                    return true;
            }, "Invalid Entry");



            $("#signup_frm").validate({
                rules: {
                    c_name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        regex_validator: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/
                    },
                    c_phone_no: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        digits: true
                    },
                    c_door_no: "required",
                    c_street_name: {
                        required: true
                    },
                    c_city: {
                        required: true,
                        regex_validator: /^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/
                    },
                    c_pincode: {
                        required: true,
                        minlength: 6,
                        maxlength: 6
                    },
                    c_state: {
                        required: true,
                        regex_validator: /^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/
                    }
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
                        regex_validator: "Password should contain a lower case ,a upper case and a number"
                    },
                    c_phone_no: {
                        required: "Phone is requried",
                        minlength: "Number should be 10 digits",
                        maxlength: "Number should be 10 digits"
                    },
                    c_door_no: "Door number is requried",
                    c_street_name: {
                        required: "Street name is required"
                    },
                    c_city: {
                        required: "City is required",
                        regex_validator: "Invalid city name"
                    },
                    c_pincode: {
                        required: "Pincode is required",
                        minlength: "Pincode must be of 6 digits",
                        maxlength: "Pincode must be of 6 digits"
                    },
                    c_state: "State is required",
                }
            })
        })
    </script>
</body>

</html>