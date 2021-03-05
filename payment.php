<?php
include "login_protected.php";
include "config.php";
$email = $_SESSION["email"];
$role = mysqli_fetch_array(mysqli_query($conn, "SELECT role FROM login_details WHERE email='$email'"))[0];
parse_str(explode("?", $_SERVER["REQUEST_URI"])[1], $details);
// print_r($details);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>

<body>
    <form action="" autocomplete="off" id="payment_frm">
        <label>Card Holder Name <br>
            <input type="text" name="c_name" id="c_name"></label><br>
        <label>Card Number<br>
            <input type="text" name="c_number" id="c_number"></label><br>
        <label>Expiry year<br>
            <input type="text" name="c_year" id="c_year"></label><br>
        <label>ccv<br>
            <input type="number" name="c_ccv" id="c_ccv"></label><br>
        <label>Amount<br>
            <input type="number" name="c_amount" id="c_amount"></label><br>
        <?php
        if ($role == "customer")
            echo   "<input type='submit' value='pay' data-book-id=" . $details['id'] . " data-book-email='" . $details['m_email'] . "' id='submit_btn'>";
        else
            echo   "<input type='submit' value='request for payment' data-book-id=" . $details['id'] . " id='submit_btn'>";
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
                                c_number: $("#c_number").val(),
                                c_year: $("#c_year").val(),
                                c_ccv: $("#c_ccv").val(),
                                c_amount: $("#c_amount").val(),
                                id: $("#submit_btn").attr("data-book-id")
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

            $("#payment_frm").validate({
                rules: {
                    c_name: "required",
                    c_number: "required",
                    c_year: "required",
                    c_ccv: "required",
                    c_amount: "required"
                },
                messages: {
                    c_name: "name is required",
                    c_number: "card number is required",
                    c_year: "expiry year is required",
                    c_ccv: "CCV is required",
                    c_amount: "amount is required"
                }
            })
        })
    </script>
</body>

</html>