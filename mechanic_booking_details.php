<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>mechanic_booking_details</title>
</head>

<body>
  <div id="booking-container">

  </div>
  <script src="./jquery/lib/jquery.js"></script>
  <script>
    $("document").ready(function() {

      $("#booking-container").load("mechanic_booking_details_display.php");

      $(document).on("click", ".accept-btn", function() {
        $.post("change_booking_status.php", {
          booking_id: $(this).attr("data-id"),
          booking_data: "accepted"
        }, function(data) {
          if (data == 1)
            $("#booking-container").load("mechanic_booking_details_display.php");
          else
            alert("Unable to accept an error has occured");
        });
      })

      $(document).on("click", ".reject-btn", function() {
        $.post("change_booking_status.php", {
          booking_id: $(this).attr("data-id"),
          booking_data: "rejected"
        }, function(data) {
          if (data == 1)
            $("#booking-container").load("mechanic_booking_details_display.php");
          else
            alert("Unable to reject an error has occured");
        })
      })

      $(document).on("click", ".request-payment-btn", function() {
        window.location.href = "payment.php?id=" + $(this).attr("data-id");
      })

    })
  </script>
</body>

</html>