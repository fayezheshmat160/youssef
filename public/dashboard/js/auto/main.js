import { swalDelete, ajaxDelete } from "../modules/delete-functions.js";

$(document).ready(function () {

    ajaxDelete();


    // Set For All Lable [*] IF Have Class [required]
    let labelRequired = $(".required");
    for (let i = 0; i <= labelRequired.length; i++) {
        $(labelRequired[i]).append(
            "<b class='text-danger font-weight-bold'> * </b>"
        );
    }

    // Auto Replace Text To Slug slug
    $(".slug").keyup(function (e) {
        let oldVal = $(this).val();
        // Filter
        let result = oldVal.replace(/[`~!@#$%^&*)(_+={}|\\"'?/<>, ]/g, "-");
        // Set
        $(this).val(result);
    });

    // For Set / In All Page Links
    let linksItems = $("#links-bar a");
    for (let i = 1; i <= linksItems.length; i++) {
        $(linksItems[i]).before("<span class='links-bar-item-slash'>/</span>");
    }

    // This Div For Set Response Result Here
    $("#header").after(`<div class='result'></div>`);
});
