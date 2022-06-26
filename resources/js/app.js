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

    $(document).on("click", function (event) {
        const target = $(event.target);
        const isElement = target.is(".header-search");
        const isChildElement = target.parents(".header-search").length !== 0;
        if (!isElement && !isChildElement) {
            $(".header-search").removeClass("show");
        }
    });

    $(document).on("click", function (event) {
        const target = $(event.target);
        const isElement = target.is(".menu-toggle");
        const isChildElement = target.parents(".menu-toggle").length !== 0;
        if (!isElement && !isChildElement) {
            $(".main-menu").removeClass("show");
        }
    });
});
