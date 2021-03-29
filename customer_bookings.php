<?php


include "login_protected.php";
include "config.php";
include "login_header.php";

$email = $_SESSION["email"];

echo "<h1>Customer Bookings</h1>;
     <div id='container'>;
    </div>";
?>

<script src="jquery/lib/jquery.js"></script>
<script>
    $("document").ready(function() {
        $("#container").load("customer_bookings_listing.php");
        $(document).on("click", ".cancel-btn", function() {
            $.post("change_booking_status.php", {
                booking_id: $(this).attr("data-id"),
                booking_data: "cancelled"
            }, function(data) {
                if (data == 1) {
                    alert("Booking canceled successfully");
                    $("#container").load("customer_bookings_listing.php");
                } else
                    console.log(data);
            })
        });

        $(document).on("click", ".pay-btn", function() {
            window.location.href = "payment.php?id=" + $(this).attr("data-id");
            // + "&m_email=" + $(this).attr("m_email");
        });
    })
</script>