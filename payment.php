<?php
include "login_protected.php";
include "config.php";
$email = $_SESSION["email"];
$role = mysqli_fetch_array(mysqli_query($conn, "SELECT role FROM login_details WHERE email='$email'"))[0];
parse_str(explode("?", $_SERVER["REQUEST_URI"])[1], $details);

$booking_details = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM booking_details WHERE booking_id={$details['id']}"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="./css/errors.css" />
    <link rel="stylesheet" href="./css/login.css" />
    <style>
        form {
            margin: 3rem 0px;
        }
    </style>
</head>

<body>
    <form action="" autocomplete="off" id="payment_frm">
        <?php
        if ($role == "customer") {
            $amount = mysqli_query($conn, "SELECT amount FROM payment_details WHERE to_email='{$booking_details['m_email']}' AND payment_status='pending'");
            $amount = mysqli_fetch_array($amount);
            echo   "
                <label>Card Holder Name <br>
                    <input type='text' name='c_name' id='c_name'></label><br><br>
                <label>Card Number<br>
                    <input type='text' name='c_number' id='c_number'></label><br><br>
                <label>Expiry year<br>
                    <input type='text' name='c_year' id='c_year'></label><br><br>
                <label>ccv<br>
                    <input type='number' name='c_ccv' id='c_ccv'></label><br><br>
                <label>Amount<br>
                <input type='number' name='c_amount' id='c_amount' value='$amount[0]'></label><br>
                <input type='submit' value='pay' data-book-id=" . $details['id'] . " data-book-email='" . $booking_details['m_email'] . "' id='submit_btn'>";
        } else
            echo   "
                <label>Account Holder Name <br>
                    <input type='text' name='c_name' id='c_name'></label><br><br>
                <label>Account Number<br>
                    <input type='text' name='a_number' id='a_number'></label><br><br>
                <label>IFSC code<br>
                    <input type='text' name='a_ifsc_code' id='a_ifsc_code'></label><br><br>
                <label>Amount<br>
                <input type='number' name='c_amount' id='c_amount'></label><br>
                <input type='submit' value='request for payment' data-book-id=" . $details['id'] . "  data-book-email='" . $booking_details['c_email'] . "' id='submit_btn'>
            ";
        ?>
    </form>
    <script src="./jquery/lib/jquery.js"></script>
    <script src="./jquery/dist/jquery.validate.js"></script>
    <script>
        $("document").ready(function() {
            $.validator.setDefaults({
                submitHandler: function() {
                    if ($("#submit_btn").val() == "request for payment") {
                        $.ajax({
                            url: "request_for_payment.php",
                            method: "post",
                            data: {
                                c_name: $("#c_name").val(),
                                a_number: $("#a_number").val(),
                                a_ifsc_code: $("#a_ifsc_code").val(),
                                c_amount: $("#c_amount").val(),
                                id: $("#submit_btn").attr("data-book-id"),
                                from_email: $("#submit_btn").attr("data-book-email")
                            },
                            success: function(data) {
                                if (data == 1)
                                    window.location.href = "payment_history.php";
                                else
                                    console.log(data);
                            }
                        })
                    } else {
                        $.ajax({
                            url: "payment_done.php",
                            method: "post",
                            data: {
                                c_name: $("#c_name").val(),
                                c_number: $("#c_number").val(),
                                c_year: $("#c_year").val(),
                                c_ccv: $("#c_ccv").val(),
                                c_amount: $("#c_amount").val(),
                                id: $("#submit_btn").attr("data-book-id"),
                                m_email: $("#submit_btn").attr("data-book-email")
                            },
                            success: function(data) {
                                if (data == 1)
                                    window.location.href = "payment_history.php";
                                else
                                    console.log(data);
                            }
                        })
                    }
                }
            })


            $.validator.addMethod("pattern_validator", function(value, element, regEx) {
                param = new RegExp(regEx);
                if (param.test(value))
                    return true;
            }, "Invalid Entry");

            $("#payment_frm").validate({
                rules: {
                    c_name: {
                        required: true,
                        pattern_validator: /^[a-z \.]{1,}[a-z]*$/i
                    },
                    c_number: {
                        required: true,
                        pattern_validator: /[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}/
                    },
                    c_year: {
                        required: true,
                        pattern_validator: /[0-9][0-2]['/'][0-9][0-9]/
                    },
                    c_ccv: {
                        required: true,
                        maxlength: 3,
                        minlength: 3
                    },
                    c_amount: "required"
                },
                messages: {
                    c_name: {
                        required: "card holder name is required",
                        pattern_validator: "Invalid card holder name"
                    },
                    c_number: {
                        required: "card number is required",
                        pattern_validator: "Invalid Card number"
                    },
                    c_year: {
                        required: "expiry year is required",
                        pattern_validator: "Invald expiry year"
                    },
                    c_ccv: {
                        required: "CCV is required",
                        maxlength: "Invalid ccv number",
                        minlength: "Invalid ccv number"
                    },
                    c_amount: "amount is required"
                }
            })
        })
    </script>
</body>

</html>