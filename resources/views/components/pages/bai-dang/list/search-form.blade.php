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

<div class="search-form-posts">
    <div class="btn-actions">
        <button class="show-search-form">Tìm kiếm nâng cao</button>
    </div>

    <form class="pc-search-form" action="{{ route('posts') }}" novalidate>
        <div class="deco">
            <i class="las la-sliders-h"></i>
        </div>

        <div class="search-content">
            <div class="form-group q">
                <input type="text" id="q" value="{{ request()->input('q') }}" class="form-control"
                    placeholder="Nhập tên bất động sản cần tìm" name="q" />
            </div>

            <div class="form-group multiselect-location">
                @include('components.common.multiple-select', [
                    'classes' => 'form-control',
                    'name' => 'location[]',
                    'items' => $wards->map(function ($item) {
                        $item->render_name = $item->district->name . ' - ' . $item->name;
                        return $item;
                    }),
                    'selected' => $wards->map(function ($ward) {
                        return in_array($ward->id, request()->input('location') ?? []) ? 'selected' : '';
                    }),
                    'nonSelectedText' => 'Khu vực',
                    'nSelectedText' => ' khu vực được chọn',
                ])
            </div>

            <div class="form-group category">
                @include('components.common.multiple-select', [
                    'classes' => 'form-control',
                    'name' => 'category[]',
                    'items' => $categories->map(function ($item) {
                        $item->render_name = $item->name;
                        return $item;
                    }),
                    'selected' => $categories->map(function ($category) {
                        return in_array($category->id, request()->input('category') ?? []) ? 'selected' : '';
                    }),
                    'nonSelectedText' => 'Loại nhà đất',
                    'nSelectedText' => ' loại được chọn',
                ])
            </div>

            <div class="form-group price-wrap">
                <div class="form-control d-flex align-items-center" id="price-zone2" type="button"
                    data-toggle="dropdown" aria-expanded="false">
                    <span>Giá (triệu đồng):&nbsp;</span>
                    <div id="price-display2" class="text-primary">{{ request()->input('price') }}</div>
                    <input type="hidden" name="price" id="price2" value="{{ request()->input('price') }}" />
                    <div class="dropdown-menu price-dropdown" aria-labelledby="price">
                        <div class="price-inputs">
                            <input type="number" class="form-control" id="min2" min="0" max="100"
                                value="{{ $min }}" />
                            <input type="number" class="form-control" id="max2" min="0" max="100"
                                value="{{ $max }}" />
                        </div>
                        <div id="slider-range2"></div>
                    </div>
                </div>
            </div>

            <div class="form-group submit-form">
                <button class="btn form-control" type="submit">Tìm kiếm</button>
            </div>
        </div>

        <div class="advanced-search-wrap">
            <span>Tìm kiếm nâng cao</span>
            <i class="las la-caret-down"></i>
        </div>

        @include('components.pages.bai-dang.list.advanced-search')
    </form>
</div>

<div class="sidebar-search-form">
    <div class="overlay"></div>
    <form class="content" action="{{ route('posts') }}" novalidate>
        <div class="top">
            <div class="close">
                <i class="las la-times"></i>
            </div>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Nhập tên bất động sản cần tìm" name="q"
                value="{{ request()->input('q') }}" />
        </div>

        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="form-group multiselect-location">
                    @include('components.common.multiple-select', [
                        'classes' => 'form-control',
                        'name' => 'location[]',
                        'items' => $wards->map(function ($item) {
                            $item->render_name = $item->district->name . ' - ' . $item->name;
                            return $item;
                        }),
                        'selected' => $wards->map(function ($ward) {
                            return in_array($ward->id, request()->input('location') ?? []) ? 'selected' : '';
                        }),
                        'nonSelectedText' => 'Khu vực',
                        'nSelectedText' => ' khu vực được chọn',
                    ])
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group">
                    @include('components.common.multiple-select', [
                        'classes' => 'form-control',
                        'name' => 'category[]',
                        'items' => $categories->map(function ($item) {
                            $item->render_name = $item->name;
                            return $item;
                        }),
                        'selected' => $categories->map(function ($category) {
                            return in_array($category->id, request()->input('category') ?? []) ? 'selected' : '';
                        }),
                        'nonSelectedText' => 'Loại nhà đất',
                        'nSelectedText' => ' loại được chọn',
                    ])
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group price-wrap">
                    <div class="range-slider">
                        <input type="text" class="form-control price-range" name="price" id="price"
                            value="{{ request()->input('price') }}" />
                        <div class="manual-input">
                            <input type="number" class="form-control min" />
                            <input type="number" class="form-control max" />
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <div class="form-control d-flex align-items-center" id="price-zone" type="button"
                        data-toggle="dropdown" aria-expanded="false">
                        <span>Giá (triệu đồng):&nbsp;</span>
                        <div id="price-display" class="text-primary">{{ request()->input('price') }}</div>
                        <input type="hidden" name="price" id="price"
                            value="{{ request()->input('price') }}" />
                        <div class="dropdown-menu price-dropdown" aria-labelledby="price">
                            <div class="price-inputs">
                                <input type="number" class="form-control" id="min" min="0" max="100"
                                    value="{{ $min }}" />
                                <input type="number" class="form-control" id="max" min="0" max="100"
                                    value="{{ $max }}" />
                            </div>
                            <div id="slider-range"></div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="form-group">
                    <input type="number" min="0" class="form-control" placeholder="Diện tích từ" name="acreage"
                        value="{{ request()->input('acreage') }}" />
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group">
                    <input type="number" min="0" class="form-control" placeholder="Số phòng ngủ" name="bedroom"
                        value="{{ request()->input('bedroom') }}" />
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group">
                    <input type="number" min="0" class="form-control" placeholder="Số phòng tắm"
                        name="toilet" value="{{ request()->input('toilet') }}" />
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group">
                    <input type="number" min="0" class="form-control" placeholder="Số tầng" name="floor"
                        value="{{ request()->input('floor') }}" />
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Tìm kiếm</button>
        </div>
    </form>
</div>

<script>
    $('.show-search-form').on('click', function() {
        $('.sidebar-search-form').addClass('show');
    });

    $('.overlay').on('click', function() {
        $('.sidebar-search-form').removeClass('show');
    });

    $('.sidebar-search-form .close').on('click', function() {
        $('.sidebar-search-form').removeClass('show');
    });
</script>

{{-- apply slider for price --}}
<script>
    $(function() {
        $('#slider-range2').slider({
            range: true,
            min: 0,
            max: 250,
            values: [{{ $min }}, {{ $max }}],
            slide: function(event, ui) {
                const min = ui.values[0];
                const max = ui.values[1];
                $('#price-display2').html(`${min} - ${max}`);
                $('#price2').val(`${min}-${max}`);
                $('#min2').val(min);
                $('#max2').val(max);
            },
        });

        $('#slider-range2').draggable();

        $('#min2').keyup(function() {
            const maxValue = Number($('#max2').val()) || 250;
            const minValue = Number($('#min2').val()) > maxValue ? maxValue : Number($('#min2').val());
            $('#slider-range2').slider('values', 0, minValue);

            const min = $('#slider-range2').slider('values', 0);
            const max = $('#slider-range2').slider('values', 1);
            $('#price-display2').html(`${min} - ${max}`);
            $('#price2').val(`${min}-${max}`);
            $('#min2').val(min);
            $('#max2').val(max);
        });

        $('#max2').keyup(function() {
            const minValue = Number($('#min2').val()) || 0;
            const maxValue = Number($('#max2').val()) < minValue ? minValue : Number($('#max2').val());
            $('#slider-range2').slider('values', 1, maxValue);

            const min = $('#slider-range2').slider('values', 0);
            const max = $('#slider-range2').slider('values', 1);
            $('#price-display2').html(`${min} - ${max}`);
            $('#price2').val(`${min}-${max}`);
            $('#min2').val(min);
            $('#max2').val(max);
        });
    });
</script>

<script>
    let min = 0;
    let max = 250;

    function updateInputs(data) {
        from = data.from;
        to = data.to;

        $('.min').prop("value", from);
        $('.max').prop("value", to);
    }

    $(".price-range").ionRangeSlider({
        skin: "round",
        type: "double",
        min: min,
        max: max,
        from: {{ $min }},
        to: {{ $max }},
        input_values_separator: '-',
        postfix: ' triệu',
        onStart: updateInputs,
        onChange: updateInputs,
        onFinish: updateInputs
    });

    const instance = $(".price-range").data("ionRangeSlider");
    $('.min').on("change", function() {
        let val = $(this).prop("value");

        // validate
        if (val < min) {
            val = min;
        } else if (val > to) {
            val = to;
        }

        instance.update({
            from: val
        });

        $(this).prop("value", val);

    });

    $('.max').on("change", function() {
        let val = $(this).prop("value");

        // validate
        if (val < from) {
            val = from;
        } else if (val > max) {
            val = max;
        }

        instance.update({
            to: val
        });

        $(this).prop("value", val);
    });
</script>

{{-- <script>
    function updateInputs2(data) {
        from = data.from;
        to = data.to;

        $('.min2').prop("value", from);
        $('.max2').prop("value", to);
    }

    $(".price-range2").ionRangeSlider({
        skin: "round",
        type: "double",
        min: min,
        max: max,
        from: {{ $min }},
        to: {{ $max }},
        input_values_separator: '-',
        postfix: ' triệu',
        onStart: updateInputs2,
        onChange: updateInputs2,
        onFinish: updateInputs2
    });

    const instance2 = $(".price-range2").data("ionRangeSlider");
    $('.min2').on("change", function() {
        let val = $(this).prop("value");

        // validate
        if (val < min) {
            val = min;
        } else if (val > to) {
            val = to;
        }

        instance2.update({
            from: val
        });

        $(this).prop("value", val);

    });

    $('.max2').on("change", function() {
        let val = $(this).prop("value");

        // validate
        if (val < from) {
            val = from;
        } else if (val > max) {
            val = max;
        }

        instance2.update({
            to: val
        });

        $(this).prop("value", val);
    });
</script> --}}

<script>
    $('.advanced-search-wrap').on('click', function() {
        $('.post-list-advanced-search').toggleClass('show');
    });
</script>
