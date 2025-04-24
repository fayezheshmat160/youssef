// CSRF TOKEN
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
let lang = $("html").attr("lang");
let baseUrl = $('meta[name="url"]').attr("content");


