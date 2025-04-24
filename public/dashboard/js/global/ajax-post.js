import * as response from "../modules/requests-response.js";
$(document).ready(function () {
    // Function Post Request
    function post(
        form = ".ajax-post",
        buttonName = "button[type=submit]",
        resultBox = ".result .row"
    ) {
        $(form + " " + buttonName).click(function () {
            // Get Target Button
            let targetButton = $(this);
            // Get Parent Form For This Button
            let targetForm = targetButton.parents(form);

            $(targetForm).ajaxForm({
                url: $(this).attr("action"),
                dataType: "json",
                type: "POST",

                beforeSend: function () {
                    response.beforeSendRequest(targetButton);
                },

                success: function (data) {
                    response.responseStatus(data, targetForm, resultBox);
                },

                error: function (dataErrors, exception) {
                    response.errorRequest(dataErrors, exception);
                },

                complete: function () {
                    response.completeRequest(targetButton);
                },
            }); // End AjaxForm
        });
    }

    post(); // Add in from class ( ajax-post )
    post(".form");

    // // Get Errors Type
    // let errorKey = "job_title.1";

    // // Split Name
    // let keySplit = errorKey.split("."),
    //     keyName  = keySplit[0],
    //     keyIndex = keySplit[1];

    // // Element
    // let elm = document.querySelectorAll(`[data-name="${keyName}"]`)[keyIndex];

    // $(elm).focus(function (e) { 
      
    //     console.log('Hola');
    // });
});
