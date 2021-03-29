<?php
include "config.php";
$email = $_SESSION["email"];
$role = mysqli_fetch_array(mysqli_query($conn, "SELECT role FROM login_details WHERE email='$email'"))[0];

if ($role == "mechanic") {
    $image_location = mysqli_query($conn, "SELECT m_photo FROM mechanic_details WHERE m_email='$email'");
    $image_location = mysqli_fetch_array($image_location)[0];
} else {
    $image_location = mysqli_query($conn, "SELECT c_photo FROM customer_details WHERE c_email='$email'");
    $image_location = mysqli_fetch_array($image_location)[0];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image upload using jquery</title>
</head>

<body>
    <form action="" enctype="multipart/form-data" id="frm">
        <?php
        echo "<img src='$image_location' alt='' id='preview_image'><br>";
        ?>
        <input type="file" id="file" name="image"><br><br>
        <p id="errors"></p>
        <input type="button" id="upload_btn" value="upload image">
    </form>
    <script src="jquery/lib/jquery.js"></script>
    <script>
        $("document").ready(function() {


            $("#upload_btn").click(function() {

                if ($("#file").val() == "")
                    $("#errors").html("No image selected");
                else {

                    var extension = $("#file").val().substr($("#file").val().indexOf(".") + 1);
                    var validExtension = ["jpg", "jpeg", "jpg", "png"];
                    if (validExtension.indexOf(extension) != -1) {

                        var fd = new FormData();
                        var files = $("#file")[0].files[0];
                        fd.append('file', files);
                        $.ajax({
                            url: "upload.php",
                            data: fd,
                            method: "post",
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                if (data != 0)
                                    $("#preview_image").attr("src", data);
                                else
                                    alert("File not uploaded");
                            }
                        })
                    } else {
                        $("#errors").html("Unsupported image format");
                        $("#file").val("");
                    }
                }
            })

        })
    </script>
</body>

</html>