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
        const container = $(".header-search-form");
        const toggler = $(".header-search");

        const isElement = container.is(target);
        const isChildElement = container.has(target).length !== 0;
        const isElement2 = toggler.is(target);
        const isChildElement2 = toggler.has(target).length !== 0;

        if (!isElement && !isChildElement) {
            if (!isElement2 && !isChildElement2) {
                toggler.removeClass("show");
            }
        }
    });

    $(document).on("click", function (event) {
        const target = $(event.target);
        const container = $(".menu-toggle");

        const isElement = container.is(target);
        const isChildElement = container.has(target).length !== 0;
        if (!isElement && !isChildElement) {
            $(".main-menu").removeClass("show");
        }
    });

    $(document).on("click", function (event) {
        const target = $(event.target);
        const container = $(".post-list-advanced-search");
        const toggler = $(".advanced-search-wrap");

        const isElement = container.is(target);
        const isChildElement = container.has(target).length !== 0;
        const isElement2 = toggler.is(target);
        const isChildElement2 = toggler.has(target).length !== 0;
        if (!isElement && !isChildElement) {
            if (!isElement2 && !isChildElement2) {
                container.removeClass("show");
            }
        }
    });
});
