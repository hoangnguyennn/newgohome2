require("./bootstrap");

$(function () {
    $(".dropdown-menu").each(function () {
        $(this).on("click", function (event) {
            event.stopPropagation();
        });
    });
});
