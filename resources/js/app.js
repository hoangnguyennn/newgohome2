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

// sync main search to advanced search
$(function () {
    const mainSearch = ".main-search";
    const advancedSearch = ".advanced-search-modal";
    const q = '[name="q"]';
    const location = '[name="location[]"]';
    const category = '[name="category[]"]';
    const sliderRange = ".slider-range";
    const priceDisplay = ".price-display";
    const price = ".price";
    const maxEl = ".max";
    const minEl = ".min";

    const checkbox = (value) => {
        if (value) {
            return `.multiple-select-dropdown input[value="${value}"]`;
        }

        return ".multiple-select-dropdown input";
    };

    $(`${mainSearch} ${q}`).on("input", function () {
        $(`${advancedSearch} ${q}`).val($(this).val());
    });

    $(`${mainSearch} ${location} ~ ${checkbox()}`).on("input", function () {
        const value = $(this).val();
        const container = $(advancedSearch);

        const input = container.find(`${location} ~ ${checkbox(value)}`);
        input.prop("checked", !input.is(":checked")).trigger("change");
    });

    $(`${mainSearch} ${category} ~ ${checkbox()}`).on("input", function () {
        const value = $(this).val();
        const container = $(advancedSearch);

        const input = container.find(`${category} ~ ${checkbox(value)}`);
        input.prop("checked", !input.is(":checked")).trigger("change");
    });

    $(`${mainSearch} ${sliderRange}`).on("slide", function (event, ui) {
        const min = ui.values[0];
        const max = ui.values[1];
        $(`${advancedSearch} ${sliderRange}`).slider("values", 0, min);
        $(`${advancedSearch} ${sliderRange}`).slider("values", 1, max);
        $(`${advancedSearch} ${priceDisplay}`).html(`${min} - ${max}`);
        $(`${advancedSearch} ${price}`).val(`${min}-${max}`);
        $(`${advancedSearch} ${minEl}`).val(min);
        $(`${advancedSearch} ${maxEl}`).val(max);
    });

    $(`${mainSearch} ${minEl}`).on("change", function () {
        const maxValue = Number($(`${mainSearch} ${maxEl}`).val()) || 250;
        const minValue =
            Number($(`${mainSearch} ${minEl}`).val()) > maxValue
                ? maxValue
                : Number($(`${mainSearch} ${minEl}`).val());

        $(`${advancedSearch} ${sliderRange}`).slider("values", 0, minValue);
        const min = $(`${advancedSearch} ${sliderRange}`).slider("values", 0);
        const max = $(`${advancedSearch} ${sliderRange}`).slider("values", 1);
        $(`${advancedSearch} ${priceDisplay}`).html(`${min} - ${max}`);
        $(`${advancedSearch} ${price}`).val(`${min}-${max}`);
        $(`${advancedSearch} ${minEl}`).val(min);
        $(`${advancedSearch} ${maxEl}`).val(max);
    });

    $(`${mainSearch} ${maxEl}`).on("change", function () {
        const minValue = Number($(`${mainSearch} ${minEl}`).val()) || 0;
        const maxValue =
            Number($(`${mainSearch} ${maxEl}`).val()) < minValue
                ? minValue
                : Number($(`${mainSearch} ${maxEl}`).val());

        $(`${advancedSearch} ${sliderRange}`).slider("values", 1, maxValue);
        const min = $(`${advancedSearch} ${sliderRange}`).slider("values", 0);
        const max = $(`${advancedSearch} ${sliderRange}`).slider("values", 1);
        $(`${advancedSearch} ${priceDisplay}`).html(`${min} - ${max}`);
        $(`${advancedSearch} ${price}`).val(`${min}-${max}`);
        $(`${advancedSearch} ${minEl}`).val(min);
        $(`${advancedSearch} ${maxEl}`).val(max);
    });
});

$(function () {
    const mainSearch = ".main-search";
    const advancedSearch = ".advanced-search-modal";
    const q = '[name="q"]';
    const location = '[name="location[]"]';
    const category = '[name="category[]"]';
    const sliderRange = ".slider-range";
    const priceDisplay = ".price-display";
    const price = ".price";
    const maxEl = ".max";
    const minEl = ".min";

    const checkbox = (value) => {
        if (value) {
            return `.multiple-select-dropdown input[value="${value}"]`;
        }

        return ".multiple-select-dropdown input";
    };

    $(`${advancedSearch} ${q}`).on("input", function () {
        $(`${mainSearch} ${q}`).val($(this).val());
    });

    $(`${advancedSearch} ${location} ~ ${checkbox()}`).on("input", function () {
        const value = $(this).val();
        const container = $(mainSearch);

        const input = container.find(`${location} ~ ${checkbox(value)}`);
        input.prop("checked", !input.is(":checked")).trigger("change");
    });

    $(`${advancedSearch} ${category} ~ ${checkbox()}`).on("input", function () {
        const value = $(this).val();
        const container = $(mainSearch);

        const input = container.find(`${category} ~ ${checkbox(value)}`);
        input.prop("checked", !input.is(":checked")).trigger("change");
    });

    $(`${advancedSearch} ${sliderRange}`).on("slide", function (event, ui) {
        const min = ui.values[0];
        const max = ui.values[1];
        $(`${mainSearch} ${sliderRange}`).slider("values", 0, min);
        $(`${mainSearch} ${sliderRange}`).slider("values", 1, max);
        $(`${mainSearch} ${priceDisplay}`).html(`${min} - ${max}`);
        $(`${mainSearch} ${price}`).val(`${min}-${max}`);
        $(`${mainSearch} ${minEl}`).val(min);
        $(`${mainSearch} ${maxEl}`).val(max);
    });

    $(`${advancedSearch} ${minEl}`).on("change", function () {
        const maxValue = Number($(`${advancedSearch} ${maxEl}`).val()) || 250;
        const minValue =
            Number($(`${advancedSearch} ${minEl}`).val()) > maxValue
                ? maxValue
                : Number($(`${advancedSearch} ${minEl}`).val());

        $(`${mainSearch} ${sliderRange}`).slider("values", 0, minValue);
        const min = $(`${mainSearch} ${sliderRange}`).slider("values", 0);
        const max = $(`${mainSearch} ${sliderRange}`).slider("values", 1);
        $(`${mainSearch} ${priceDisplay}`).html(`${min} - ${max}`);
        $(`${mainSearch} ${price}`).val(`${min}-${max}`);
        $(`${mainSearch} ${minEl}`).val(min);
        $(`${mainSearch} ${maxEl}`).val(max);
    });

    $(`${advancedSearch} ${maxEl}`).on("change", function () {
        const minValue = Number($(`${advancedSearch} ${minEl}`).val()) || 0;
        const maxValue =
            Number($(`${advancedSearch} ${maxEl}`).val()) < minValue
                ? minValue
                : Number($(`${advancedSearch} ${maxEl}`).val());

        $(`${mainSearch} ${sliderRange}`).slider("values", 1, maxValue);
        const min = $(`${mainSearch} ${sliderRange}`).slider("values", 0);
        const max = $(`${mainSearch} ${sliderRange}`).slider("values", 1);
        $(`${mainSearch} ${priceDisplay}`).html(`${min} - ${max}`);
        $(`${mainSearch} ${price}`).val(`${min}-${max}`);
        $(`${mainSearch} ${minEl}`).val(min);
        $(`${mainSearch} ${maxEl}`).val(max);
    });
});
