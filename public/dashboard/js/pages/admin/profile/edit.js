$(document).ready(function () {
    /**
     * File Map
     * 1- Crop & Update Profile Avatar
     * 2- Portfolio
     */




    /***************************************************| Crop & Update Profile Avatar |***************************************************/

    const avatarPreviewImage = document.getElementById("previewImage"),
        modelUpdateProfileAvatar = "#model-update-profile-avatar";
    let cropper;

    $("#input-profile-avatar").change(function (e) {
        // Show Model
        $(modelUpdateProfileAvatar).show();

        // Get Target File After Choose
        let file = e.target.files[0];

        // Check If Isset File
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $(avatarPreviewImage).attr("src", e.target.result);
                cropper = new Cropper(avatarPreviewImage, {
                    aspectRatio: 1 / 1, // تحديد نسبة العرض إلى الارتفاع للقص
                    viewMode: 2, // يظهر الصورة داخل المنطقة بالكامل مع الحفاظ على نسبة العرض إلى الارتفاع
                    crop: function (event) {},
                });
            };
            reader.readAsDataURL(file);
        } // End if
    });

    $(modelUpdateProfileAvatar + " .model-btn-save").click(function (e) {
        // Get The Cropped
        let croppedCanvas = cropper.getCroppedCanvas();

        // Check
        if (croppedCanvas) {
            // Send Post Request For Upload Image Update
            $.post(
                $("#url").val(),
                {
                    baseImage: croppedCanvas.toDataURL(),
                    id: $("#profile-id").val(),
                },
                function (data, textStatus, jqXHR) {},
                "json"
            ); // end post
        }
    });

    // Close The Model
    $(modelUpdateProfileAvatar + " .model-close").click(function (e) {
        $(modelUpdateProfileAvatar).fadeOut(150);
    });
    $(document).keyup(function (e) {
        if (e.keyCode == 27) {
            $(modelUpdateProfileAvatar).fadeOut(150);
        }
    });

    /********************************************************| Portfolio |********************************************************/

    let inputSocialUrl = document.querySelector(".input-social-media-url");
    $("#select-social-media").change(function (e) {
        e.preventDefault();
        let val = $(this).val();
        let text = $(this).text();

        // Show Input
        $(inputSocialUrl).fadeIn(100);
        // Set Name
        $(inputSocialUrl).attr("name", val);
        $(inputSocialUrl).attr("placeholder", `https://${val}.com`);
    });



});
