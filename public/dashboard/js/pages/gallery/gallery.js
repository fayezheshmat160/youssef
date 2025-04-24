import { responseStatus } from "../../modules/requests-response.js";
import { copyFromAttr } from "../../modules/copy-clipboard.js";
import {
    swalCancel,
    swalOk,
    areYouSureToDelete,
    warning,
} from "../../modules/trans.js";
$(document).ready(function () {
    const uploadUrl = adminUrl + "/" + "gallery/store",
        fileInput = document.querySelector(".input-upload"),
        maxUploadSize = 52428800, // 50MB
        maxUploadFile = 20;
    let btnBrowse = "#btn-browse";
    $(btnBrowse).click(function (e) {
        e.preventDefault();
        $(fileInput).click();
    });
    // Remove Progress
    function removeProgress() {
        $("#upload-progress").remove();
    }
    // In Script
    $(fileInput).change(function (e) {
        let files = e.target.files,
            totalFilesSize = 0,
            countFiles = files.length;
        removeProgress();
        if (countFiles <= maxUploadFile) {
            // Get Totla Files Size
            for (let i = 0; i < files.length; i++) {
                totalFilesSize += files[i].size;
            }

            // Check Files Size
            if (totalFilesSize <= maxUploadSize) {
                $("#form-upload").ajaxSubmit({
                    url: uploadUrl,
                    type: "POST",

                    beforeSend: function (data, two, three) {
                        removeProgress();
                        $("#uploader .box")
                            .prepend(`<div id="upload-progress" class="progress">
                    <div class="progress-bar progress-bar-striped bg-prmariy  progress-bar-animated" role="progressbar"
                        style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        <div class="percent-box text-right mr-1">
                            <span class="perc">0</span>%
                        </div>
                    </div>
                </div>`);

                        $(".upload-icon").addClass("icon-anim");
                    },
                    uploadProgress: function (event, pos, total, percent) {
                        $("#uploader .box .progress .perc").text(percent);
                        $("#uploader .box .progress .progress-bar").css(
                            "width",
                            percent + "%"
                        );
                        $(btnBrowse).attr("disabled", "disabled");
                        $(btnBrowse).text("( " + countFiles + " ) Upload...");

                        if (percent == 100) {
                            $("#uploader .box .progress .percent-box").text(
                                "Processing..."
                            );
                        }
                    },
                    success: function (data, two, three) {
                        responseStatus(data, "#form-upload");
                        // Button
                        $(btnBrowse).text("Browse File");
                        $(btnBrowse).removeAttr("disabled");
                        $(".upload-icon").removeClass("icon-anim");

                        if (data.status == "error") {
                            removeProgress();
                        } else {
                            $("#uploader .box .progress .percent-box").text(
                                "Successfully Uploading"
                            );
                            // Progress
                            $(".progress-bar").addClass("bg-success");
                            // Progress Remove Classes
                            $(".progress-bar").removeClass(
                                "progress-bar-striped"
                            );
                            $(".progress-bar").removeClass(
                                "progress-bar-animated"
                            );
                        }
                    },
                }); // End AjaxForm
            } else {
                toastr.warning(
                    "The Maximum Allowed Is " + maxUploadSize / 1024 / 1024 + "MP"
                );
            }
        } else {
            toastr.warning(
                "The Maximum Allowed Is " + maxUploadFile + " Files"
            );
        }

        $(fileInput).val("");
    });


    /****************************************************************************************************/

    // Global Var
    let filesExtensions = $("meta[name=files-extensions]").attr("content"),
        // Src Url
        oldSrc = null,
        nextSrc = null,
        prevSrc = null,
        // Push All Images In Array
        arrayOfFiles = [],
        // Src Index In filesArray
        oldSrcIndex = 0,
        nextSrcIndex = 0,
        prevSrcIndex = 0;

    // Images Size
    const large = "large",
        medium = "medium",
        small = "small";

    // Thumbnails Box , img , info
    const thumbnailsCol = document.querySelectorAll(".thumbnails-col"),
        thumbnailsBox = document.querySelectorAll(
            ".thumbnails-col .thumbnails-box"
        ),
        thumbnailsAttachment = document.querySelectorAll(
            ".thumbnails-col .attachment"
        ),
        info = document.querySelectorAll(".info");

    // Show Box
    const showBox = document.getElementById("show-box"),
        showBoxOverlay = document.querySelector(".show-box-overlay"),
        imgPreview = document.getElementById("img-preview"),
        filePreview = document.getElementById("file-preview"),
        selected = "selected";

    // Actions Button Classes ( open , close , next , prev )
    const btnOpen = document.querySelectorAll(".btn-open"),
        // This Button Available In Show Box
        btnClose = document.getElementById("btn-close"),
        btnNext = document.getElementById("btn-next"),
        btnPrev = document.getElementById("btn-prev");

    // Info Table : For Set File Info Inside This Table Like ( File Name , Upload By , Upload At )
    const infoTableFileName = document.getElementById("file-name"),
        infoTableUploadAt = document.getElementById("upload-at"),
        infoTableUploadBy = document.getElementById("upload-by");

    /*
    |
    | Array Of File Push Names
    |
    */
    //

    let i = 0;
    do {
        // Push All Image To Array
        arrayOfFiles.push($(thumbnailsAttachment[i]).attr("data-src"));
        i++;
    } while (i < thumbnailsCol.length);

    /*
    |
    | Replace Src Size ( large , medium , small )
    |
    */
    function replaceSrcSize(size = small) {
        if (size == large) {
            // Return Large Src
            return oldSrc.replace(small, large);
        } else if (size == medium) {
            // Return Medium Src
            return oldSrc.replace(small, medium);
        } else {
            // Retun Small Src
            return oldSrc;
        }
    }

    /*
    |
    | Check File Type
    |
    */
    function checkType() {
        // Split File And Get End Of File ( Extension )
        let splitSrc = oldSrc.split("."),
            targetExt = splitSrc[splitSrc.length - 1];

        if (!filesExtensions.includes(targetExt.toUpperCase()) === true) {
            return "file";
        } else {
            return "image";
        }
    }

    /*
    |
    | Get Attech Extension
    |
    */
    function getExtension() {
        // Split File And Get End Of File ( Extension )
        let splitSrc = oldSrc.split(".");
        return splitSrc[splitSrc.length - 1];
    }

    /*
    |
    | Get Next & Prev Src
    |
    */
    function getNextSrc() {
        // Get Old Index
        oldSrcIndex = arrayOfFiles.indexOf(oldSrc);
        nextSrcIndex = oldSrcIndex + 1;
        // Get Next & Prev Src From Image Array And Assin In Varibles
        nextSrc = arrayOfFiles[nextSrcIndex];
        // Disabled Next Button IF Not Have Next
        return nextSrc;
    }
    function getPrevSrc() {
        // Get Old Index
        oldSrcIndex = arrayOfFiles.indexOf(oldSrc);
        prevSrcIndex = oldSrcIndex - 1;
        // Get Next & Prev Src From Image Array And Assin In Varibles
        prevSrc = arrayOfFiles[prevSrcIndex];
        // Disabled Next Button IF Not Have Next
        return prevSrc;
    }

    /*
    |
    | Disabled Buttons
    |
    */
    let activeBtnNext = true,
        activeBtnPrev = true;
    function disabledBtnNext() {
        // Get Old And Add Plus 1
        nextSrcIndex = oldSrcIndex + 1;

        if (nextSrcIndex >= arrayOfFiles.length) {
            $(btnNext).attr("disabled", "disabled");
            activeBtnNext = false;
        } else {
            $(btnNext).removeAttr("disabled");
            activeBtnNext = true;
        }
    }
    function disabledBtnPrev() {
        prevSrcIndex = oldSrcIndex;
        if (prevSrcIndex == 0) {
            $(btnPrev).attr("disabled", "disabled");
            activeBtnPrev = false;
        } else {
            $(btnPrev).removeAttr("disabled");
            activeBtnPrev = true;
        }
    }

    // Toggle Preview
    function togglePreview() {
        // Check If Type File Or Image
        if (checkType() == "file") {
            // Hide Image
            $(imgPreview).hide(0);
            $(imgPreview).attr("src", "");

            // Set Src In Show Image Preview
            $(filePreview).text(getExtension());
            $(filePreview).show(0);
        } else {
            // Hide File
            $(filePreview).text("");
            $(filePreview).hide(0);

            // Set Src In Show Image Preview
            $(imgPreview).show(0);
            $(imgPreview).attr("src", replaceSrcSize(large));
        }
    }

    // Get Attech Data
    let uploaderEmail = null,
        uploaderId = null,
        uploadAt = null,
        attechName = null,
        attechId = null;
    function getData() {
        // Class
        let infoBox = "." + selected + " .info";

        // Get Data
        uploaderEmail = $(infoBox).attr("data-uploader-email");
        uploaderId = $(infoBox).attr("data-uploader-id");
        uploadAt = $(infoBox).attr("data-created-at");
        attechName = $(infoBox).attr("data-attech-name");
        attechId = $("." + selected)
            .find(thumbnailsBox)
            .attr("data-attech-id");

        // Set Data
        infoTableFileName.innerHTML = attechName;
        infoTableUploadAt.innerHTML = uploadAt;
        infoTableUploadBy.innerHTML = uploaderEmail;
        $(infoTableUploadBy).attr(
            "href",
            `${adminUrl + "/profile/show/" + uploaderId}`
        );

        /**
         *
         *
         */
        let cleanPath = $("#clean-path").val(), // Get Clean Path From Input
            fullPath = cleanPath + "/" + attechName;

        if (checkType() == "file") {
            $("#images-copy-section").hide(0);
            $("#files-copy-section").show(0);

            // Create Attr And Set Data
            $("#input-file-copy").val(fullPath);
            $("#copyFile").attr("data-clipboard-text", fullPath);
        } else {
            $("#files-copy-section").hide(0);
            $("#images-copy-section").show(0);

            // Create Attr And Set Data
            $("#copyLarge").attr("data-clipboard-text", fullPath);

            $("#copyMedium").attr(
                "data-clipboard-text",
                fullPath.replace(large, medium)
            );

            $("#copySmall").attr(
                "data-clipboard-text",
                fullPath.replace(large, small)
            );
        }
    }

    /*
    |
    | Open Show Box
    |
    */
    function open(target) {
        $("body").css("overflow", "hidden");
        // Get Target Src And Assin In oldSrc
        oldSrc = target.find(thumbnailsAttachment).attr("src");
        // Check IF Not Exist ( src ) Get ( data-src ) And Assin In OldSrc
        if (oldSrc == undefined) {
            oldSrc = target.find(thumbnailsAttachment).attr("data-src");
        }
        // Get Index Of src from array
        oldSrcIndex = arrayOfFiles.indexOf(oldSrc);
        togglePreview();
        $(thumbnailsCol).removeClass(selected); // Reset All Class Selected In Cols
        target.parent(thumbnailsCol).addClass(selected); // Add Class To Parent

        // Get Data And Set To Preview
        getData();

        // Show
        $(showBox).show();
        $(showBoxOverlay).show();

        // Check Length For Disabled
        disabledBtnNext();
        disabledBtnPrev();
    }
    $(btnOpen).click(function () {
        open($(this));
    });

    /*
    |
    | Next
    |
    */
    function next() {
        if (activeBtnNext == true) {
            // Get Next Src
            oldSrc = getNextSrc();
            // Check IF Have Class Selected In Target Cols
            if ($(thumbnailsCol).hasClass(selected)) {
                // Get Old Div Have This Class
                $("." + selected)
                    .next(thumbnailsBox)
                    .addClass(selected); // Add The Next
                $("." + selected)
                    .prev(thumbnailsBox)
                    .removeClass(selected); // Remove The Prev
                getData();
                togglePreview();
            }

            oldSrcIndex++;
            disabledBtnPrev();
            disabledBtnNext();
        }
    }
    $(btnNext).click(function () {
        next();
    });
    $(document).keyup(function (e) {
        if (e.keyCode == 39) {
            next();
        }
    });

    /*
    |
    | Prev
    |
    */
    function prev() {
        if (activeBtnPrev == true) {
            // Get Next Src
            oldSrc = getPrevSrc();
            // Check IF Have Class Selected In Target Cols
            if ($(thumbnailsCol).hasClass(selected)) {
                // Get Old Div Have This Class
                $("." + selected)
                    .prev(thumbnailsBox)
                    .addClass(selected); // Remove The Prev

                $("." + selected)
                    .next(thumbnailsBox)
                    .removeClass(selected); // Add The Next
                getData();
                togglePreview();

                oldSrcIndex--;
                disabledBtnNext();
                disabledBtnPrev();
            }
        }
    }
    $(btnPrev).click(function (e) {
        prev();
    });
    $(document).keyup(function (e) {
        if (e.keyCode == 37) {
            prev();
        }
    });

    /*
    |
    | Close Show Box
    |
    */
    function close() {
        $("body").css("overflow", "auto");
        // Reset Old Src
        oldSrc = null;
        // Hide Image
        $(filePreview).text("");
        // Hide File
        $(imgPreview).attr("src", null);
        // Reset All Class Selected In Cols
        $(thumbnailsCol).removeClass(selected);

        // Show
        $(showBox).hide();
        $(showBoxOverlay).hide();
    }

    $(btnClose).click(function () {
        close();
    });
    $(document).keyup(function (e) {
        if (e.keyCode == 27) {
            close();
        }
    });
    $(showBoxOverlay).click(function () {
        close();
    });

    /*
    |
    | Delete Image From DB
    |
    */
    let btnDelete = $(".btn-delete");
    btnDelete.click(function (e) {
        activeBtnNext = false;
        activeBtnPrev = false;

        swal({
            title: warning,
            text: areYouSureToDelete,
            icon: "warning",
            buttons: [swalCancel, swalOk],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                let url = adminUrl + "/gallery/destroy"; // Get Form URL
                // Request To Delete
                $.post(
                    url,
                    { _method: "DELETE", id: attechId },
                    function (data) {},
                    "json"
                );
                //  Hide The Parent Box
                $("." + selected).hide(0);
                close();
            }
            disabledBtnNext();
            disabledBtnPrev();
        });
    });

    // Copied
    copyFromAttr("#copyFile");
    copyFromAttr("#copyLarge");
    copyFromAttr("#copyMedium");
    copyFromAttr("#copySmall");
});
