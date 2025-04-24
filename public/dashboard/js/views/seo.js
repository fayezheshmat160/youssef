$(document).ready(function () {
    // Global
    let inputMetaDescription = ".input-meta-description",
        inputMetaTitle = ".input-meta-title";
    /**
  | 
  | Set Progress Bar & Max Number For Meta Tag And Page Title
  |
  */

    // Meta Descraption
    let description = $("#description-max-length span"),
        descriptionMaxLength = 150,
        descriptionHalfLength = descriptionMaxLength - 55;
    description.text(descriptionMaxLength); // Set Number Of Length in span
    $(inputMetaDescription).keyup(function (e) {
        let valLength = $(this).val().length; // Input Length

        // Edit the number of characters value
        description.text(descriptionMaxLength - valLength);
        // Check IF Max Length less than input value Set Danger Color
        if (descriptionMaxLength < valLength) {
            description.addClass("font-weight-bold text-danger");
        } else {
            // Else Max Length larger than input value Remove Danger Color
            description.removeClass("font-weight-bold text-danger");
        }

        // Auto Set Width From Length Value
        $(".progress-bar").css("width", valLength + "%");
        // Check IF Input Value Larger Max Value Set Danger Color Background
        if (valLength > descriptionMaxLength) {
            $(".progress-bar").removeClass("bg-warning");
            $(".progress-bar").addClass("bg-danger");
        } else if (valLength > descriptionHalfLength) {
            // Else If Input Value Equal Half Length Set Success Color Background
            $(".progress-bar").removeClass("bg-warning");
            $(".progress-bar").removeClass("bg-danger");
            $(".progress-bar").addClass("bg-success");
        } else if (valLength < descriptionHalfLength) {
            // Else If Input Value Not Equal Half Length Set Warning Color Background
            $(".progress-bar").removeClass("bg-success");
            $(".progress-bar").removeClass("bg-danger");
            $(".progress-bar").addClass("bg-warning");
        }
    });

    // Meta Page Title
    let pageTitle = $("#page-title-max-length span"),
        pageTitleMaxLength = 60;
    pageTitle.text(pageTitleMaxLength); // Set Number Of Length in span
    $(inputMetaTitle).keyup(function (e) {
        let valLength = $(this).val().length; // Input Length
        // Edit the number of characters value
        pageTitle.text(pageTitleMaxLength - valLength);
        // Check IF Max Length less than input value Set Danger Color
        if (pageTitleMaxLength < valLength) {
            pageTitle.addClass("font-weight-bold text-danger");
        } else {
            // Else Max Length larger than input value Remove Danger Color
            pageTitle.removeClass("font-weight-bold text-danger");
        }
    });

    /*
 | SEO Box & Browser Preview
 | Get Value From Input Slug And Set In Browser Preview Slug
 | Function autoSetValueInBrowserFields()
 | 1- Input Class Name Or ID
 | 2- Field Class Name Or ID To Set Value
 | 3- If Need Slug Set true
 */
    function autoSetValueInBrowserFields(
        fromInput,
        setValueIn,
        slugOption = false
    ) {
        if (slugOption == true) {
            $(fromInput).keyup(function (e) {
                let fromInput = $(this).val();
                // Filter
                let result = fromInput
                    .toString()
                    .replace(/[`~!@#$%^&*)(_+={}|\\"'?/<>, ]/g, "-");
                // Set
                setValueIn.text(result);
            });
        } else {
            $(fromInput).keyup(function (e) {
                setValueIn.text($(this).val());
            });
        }
    }
    // Slug
    autoSetValueInBrowserFields($("#slug"), $("#browser-preview .slug"), true);
    // Meta Page Title
    autoSetValueInBrowserFields(
        $(inputMetaTitle),
        $("#browser-preview .page-title .title")
    );
    // Meta Desc
    autoSetValueInBrowserFields(
        $(inputMetaDescription),
        $("#browser-preview .meta-desc")
    );
});
