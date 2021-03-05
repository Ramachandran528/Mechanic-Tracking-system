<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/errors.css" />
    <link rel="stylesheet" href="./css/login.css" />
    <title>Login page</title>
</head>

<body>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" id="login-frm" autocomplete="off">
        <h1 class="heading">Login</h1>
        <input type="email" name="email" id="email" placeholder="E-mail"><br><br>
        <label id="custom-error"></label>
        <input type="password" name="password" id="password" placeholder="Password"><br><br>
        <input type="submit" value="login" name="login">
        <p class="sign-up-link">Create a new account? <a href="#">sign up</p>
    </form>
    <script src="./jquery/lib/jquery.js"></script>
    <script src="./jquery/dist/jquery.validate.js"></script>
    <script src="./jquery/src/additional/pattern.js"></script>
    <script>
        $("document").ready(function() {

            $.validator.addMethod("password_validator", function(value, element) {
                param = new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/);
                if (param.test(value))
                    return true;
            }, "Invalid password")

            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        url: "user_exists.php",
                        method: "post",
                        data: $("#login-frm").serialize(),
                        success: function(data) {
                            console.log("data" + data);
                            if (data == -1)
                                $("#custom-error").text("An user with this email or password does not exists");
                            else if (data == "customer")
                                window.location.href = "customer.php";
                            else if (data == "mechanic")
                                window.location.href = "mechanic.php";
                        }
                    })
                }
            })

            $("#login-frm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        password_validator: true
                    }
                },
                messages: {
                    email: {
                        required: "An email is required",
                        email: "Invalid email"
                    },
                    password: {
                        required: "A password is required",
                        minlength: "Password should contain a minimum of 6 characters",
                        password_validator: "Password should contain a lower,a upper and a number"
                    }
                }
            })
        });
    </script>
</body>

</html>