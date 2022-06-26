@php
$min = 0;
$max = 250;
$price = request()->input('price');
if ($price) {
    $priceRange = explode('-', $price);

    if ($priceRange && count($priceRange) == 2) {
        $min = (float) $priceRange[0];
        $max = (float) $priceRange[1];

        if ($min > $max) {
            $temp = $min;
            $min = $max;
            $max = $min;
        }
    }
}
@endphp

<form class="header-search-form" action="{{ route('posts') }}">
    <div class="form-group">
        <label for="q">Từ khóa</label>
        <input type="text" class="form-control" placeholder="Nhập tên bất động sản cần tìm" name="q"
            value="{{ request()->input('q') }}" />
    </div>

    <div class="form-group">
        <label for="category">Loại nhà đất</label>
        <select name="category[]" class="form-control" multiple>
            @foreach ($categories as $category)
                @php
                    $selected = in_array($category->id, request()->input('category') ?? []) ? 'selected' : '';
                @endphp
                <option value="{{ $category->id }}" {{ $selected }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <div class="range-slider">
            <label for="price3">Giá:</label>
            <input type="text" class="form-control price-range3" name="price" id="price3" />
            <div class="manual-input">
                <input type="number" class="min3" />
                <input type="number" class="max3" />
            </div>
        </div>
    </div>

    <button type="submit" class="btn">
        <i class="las la-search"></i>Tìm kiếm
    </button>
</form>

<script>
    let min3 = 0;
    let max3 = 250;

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
