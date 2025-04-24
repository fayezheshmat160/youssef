$(document).ready(function () {
    $("#btn-add-new-email").click(function (e) {
        e.preventDefault();
        $("#emails-box").append(
            `<div class="parent-email"><div class="row"><div class="col-2"><div class="btn-remove-email btn btn-soft-danger btn-block"><i class="fa fa-trash"></i></div></div><div class="col-10"><div class="form-group dir-ltr"><input type="email" name="email[]" value="" data-name="email" data-laravel-translatable="email--lara-trans-error" required="" placeholder="هذا البريد سوف يعرض في صفحات الموقع الرئيسة مثل ( اتصل بنا )"></div></div></div></div>`
        );
        removeEmail();
    });
    function removeEmail() {
        $(".btn-remove-email").click(function (e) {
            e.preventDefault();
            $(this).parents(".parent-email").remove();
        });
    }
    removeEmail();

    $("#btn-add-new-phone").click(function (e) {
        e.preventDefault();
        $("#phones-box").append(
            `<div class="parent-phone"><div class="row"><div class="col-2"><div class="btn-remove-phone btn btn-soft-danger btn-block"><i class="fa fa-trash"></i></div></div><div class="col-10"><div class="form-group dir-ltr"><input type="number" name="phone[]" data-name="phone" data-laravel-translatable="email--lara-trans-error" required="" placeholder="كود البلد يتبعه رقم الهاتف"></div></div></div></div>`
        );
        removePhone();
    });

    function removePhone() {
        $(".btn-remove-phone").click(function (e) {
            e.preventDefault();
            $(this).parents(".parent-phone").remove();
        });
    }
    removePhone();

    //
    $("#btn-add-new-receiving-email").click(function (e) {
        e.preventDefault();
        $("#receiving-emails-box").append(
            `<div class="parent-receiving-email"><div class="row"><div class="col-2"><div class="btn-remove-receiving-email btn btn-soft-danger btn-block"><i class="fa fa-trash"></i></div></div><div class="col-10"><div class="form-group dir-ltr"><input type="email" name="email[]" value="" data-name="email" data-laravel-translatable="email--lara-trans-error" required=""></div></div></div></div>`
        );
        removeReceivingEmail();
    });
    function removeReceivingEmail() {
        $(".btn-remove-receiving-email").click(function (e) {
            e.preventDefault();
            $(this).parents(".parent-receiving-email").remove();
        });
    }
    removeReceivingEmail();
});
