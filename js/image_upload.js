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