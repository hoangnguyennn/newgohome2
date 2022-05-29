require("./bootstrap");

$(function () {
    $(".dropdown-menu").each(function () {
        $(this).on("click", function (event) {
            event.stopPropagation();
        });
    });

    // submit logout form
    $(".btn-logout").each(function () {
        $(this).on("click", function (event) {
            event.preventDefault();
            $("#logout-form").trigger("submit");
        });
    });

    // convert currency to VND value
    function toCurrency(num) {
        const numNum = Number(num);
        if (!isNaN(numNum)) {
            return Number(num).toLocaleString("vi-VN", {
                style: "currency",
                currency: "VND",
            });
        }

        return num;
    }

    $(".currency").each(function () {
        $(this).text(toCurrency($(this).text()));
    });
});
