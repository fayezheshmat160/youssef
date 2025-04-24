/*
|
| Copy From Attr In Button Attr Name ( data-clipboard-text )
| 
|
*/
export function copyFromAttr(target) {
    $(target).click(function () {
        let clipboard = new ClipboardJS(target);
        clipboard.on("success", function (e) {
            $(target).text("Copied!");
            setTimeout(changeText, 2000);
            function changeText() {
                $(target).text("Copy");
            }
        });
    });
}
