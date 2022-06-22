<form class="header-search-form" action="{{ route('posts') }}">
    <div class="form-group">
        <label for="q">Từ khóa</label>
        <input type="text" class="form-control" placeholder="Nhập tên bất động sản cần tìm" name="q" />
    </div>

    <div class="form-group">
        <label for="category">Loại nhà đất</label>
        <select name="category[]" class="form-control" multiple>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <div class="range-slider">
            <label for="price3">Giá:</label>
            <input type="text" class="form-control price-range3" name="price" id="price3" />
            <div class="manual-input">
                <input type="text" class="min3" />
                <input type="text" class="max3" />
            </div>
        </div>
    </div>

    <button type="submit" class="btn">
        <i class="las la-search"></i>Tìm kiếm
    </button>
</form>

<script>
    let min3 = 0;
    let max3 = 150;

    function updateInputs3(data) {
        from = data.from;
        to = data.to;

        $('.min3').prop("value", from);
        $('.max3').prop("value", to);
    }

    $(".price-range3").ionRangeSlider({
        skin: "round",
        type: "double",
        min: min3,
        max: max3,
        from: min3,
        to: max3,
        input_values_separator: '-',
        postfix: ' triệu',
        onStart: updateInputs3,
        onChange: updateInputs3,
        onFinish: updateInputs3
    });

    const instance3 = $(".price-range3").data("ionRangeSlider");
    $('.min3').on("change", function() {
        let val = $(this).prop("value");

        // validate
        if (val < min) {
            val = min;
        } else if (val > to) {
            val = to;
        }

        instance3.update({
            from: val
        });

        $(this).prop("value", val);

    });

    $('.max3').on("change", function() {
        let val = $(this).prop("value");

        // validate
        if (val < from) {
            val = from;
        } else if (val > max) {
            val = max;
        }

        instance3.update({
            to: val
        });

        $(this).prop("value", val);
    });
</script>
