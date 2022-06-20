<form class="header-search-form" action="{{ route('posts') }}">
    <div class="form-group">
        <label for="q">Từ khóa</label>
        <input type="text" class="form-control" placeholder="Nhập tên bất động sản cần tìm" name="q" />
    </div>

    <div class="form-group">
        <label for="category">Loại nhà đất</label>
        <select name="category" class="form-control">
            <option value="">Loại nhà đất</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <div class="range-slider">
            <label for="price3">Giá:</label>
            <input type="text" class="form-control price-range3" name="price" id="price3" />
        </div>
    </div>

    <button type="submit" class="btn">
        <i class="las la-search"></i>Tìm kiếm
    </button>
</form>

<script>
    let min3 = 0;
    let max3 = 150;

    $(".price-range3").ionRangeSlider({
        skin: "round",
        type: "double",
        min: min3,
        max: max3,
        from: min3,
        to: max3,
        input_values_separator: '-',
        postfix: ' triệu'
    });
</script>
