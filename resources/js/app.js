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
            if (numNum > 1_000_000_000) {
                return Math.round(numNum / 1_000_000) / 1_000 + " tỉ";
            }

            if (numNum > 1_000_000) {
                return Math.round(numNum / 1_000) / 1_000 + " triệu";
            }

            if (numNum > 1_000) {
                return Math.round(numNum / 1_000) + " nghìn";
            }

            return numNum;
        }

        return num;
    }

    $(".currency").each(function () {
        $(this).text(toCurrency($(this).text()));
    });
});
