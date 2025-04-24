$(document).ready(function () {
    /**
     * - Bootstrap
     * - Summernote Editor
     * - Toastr Alert
     * - Nice Select
     * - Lazy
     */

    // Bootstrap
    let tip = $(".tip"),
        toolTipDir = "top";
    if (tip.length > 0) {
        // Auto Set Dir
        if (tip.hasClass("left")) {
            toolTipDir = "left";
        } else if (tip.hasClass("right")) {
            toolTipDir = "right";
        } else if (tip.hasClass("bottom")) {
            toolTipDir = "bottom";
        }

        tip.attr("data-toggle", "tooltip");
        tip.attr("data-placement", toolTipDir);
        $(".tip").tooltip();
    }

    // Summernote Editor
    let editor = $(".editor");
    if (editor.length > 0) {
        $(".editor").summernote();
        if (editor.hasClass("remove-upload-image")) {
            $(".note-group-select-from-files").remove();
        }
    }

    // Toastr Alert
    toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    // Nice Select
    let niceSelect = $(".nice-select");
    if (niceSelect.length > 0) {
        $(".nice-select").niceSelect();
    }

    /*
    |
    | Lazy Load Image
    | Chnage Image src to => data-src
    | And Set Class lazy in img class like
    | Output => <img class="lazy" data-src="" />
    */
    let lazy = $(".lazy");
    if (lazy.length > 0) {
        $(".lazy").lazy();
    }

    /**
     * iCheck
     */
    if ($('input[type="radio"]').length > 0) {
        $('input[type="radio"]').iCheck({
            radioClass: "iradio_square-blue",
            checkboxClass: 'icheckbox_square-blue',
            increaseArea: '20%' // زيادة منطقة النقر
        });
    }


  

});
