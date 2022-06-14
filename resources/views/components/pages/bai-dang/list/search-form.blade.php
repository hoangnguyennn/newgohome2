@php
$min = 0;
$max = 500;
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
        <button class="show-search-form">Show Filters</button>
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

            <div class="form-group multiselect-localtion">
                <select id="location" name="location[]" class="form-control" multiple="multiple">
                    @foreach ($wards as $ward)
                        @php
                            $selected = in_array($ward->id, request()->input('location') ?? []) ? 'selected' : '';
                        @endphp
                        <option value="{{ $ward->id }}" {{ $selected }}>
                            {{ $ward->district->name }} - {{ $ward->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group category">
                <select id="category" name="category" class="form-control">
                    <option value="">Loại nhà đất</option>
                    @foreach ($categories as $category)
                        @php
                            $selected = request()->input('category') == $category->id ? 'selected' : '';
                        @endphp
                        <option value="{{ $category->id }}" {{ $selected }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
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
                <div class="form-group multiselect-localtion">
                    <select name="location[]" class="form-control" multiple="multiple">
                        @foreach ($wards as $ward)
                            @php
                                $selected = in_array($ward->id, request()->input('location') ?? []) ? 'selected' : '';
                            @endphp
                            <option value="{{ $ward->id }}" {{ $selected }}>{{ $ward->district->name }} -
                                {{ $ward->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group">
                    <select name="category" class="form-control">
                        <option value="">Loại nhà đất</option>
                        @foreach ($categories as $category)
                            @php
                                $selected = request()->input('category') == $category->id ? 'selected' : '';
                            @endphp
                            <option value="{{ $category->id }}" {{ $selected }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <div class="form-control d-flex align-items-center" id="price-zone" type="button"
                        data-toggle="dropdown" aria-expanded="false">
                        <span>Giá (triệu đồng):&nbsp;</span>
                        <div id="price-display" class="text-primary">{{ request()->input('price') }}</div>
                        <input type="hidden" name="price" id="price" value="{{ request()->input('price') }}" />
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
                </div>
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
                    <input type="number" min="0" class="form-control" placeholder="Số phòng tắm" name="toilet"
                        value="{{ request()->input('toilet') }}" />
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
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
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
        $('#slider-range').slider({
            range: true,
            min: 0,
            max: 500,
            values: [{{ $min }}, {{ $max }}],
            slide: function(event, ui) {
                const min = ui.values[0];
                const max = ui.values[1];
                $('#price-display').html(`${min} - ${max}`);
                $('#price').val(`${min}-${max}`);
                $('#min').val(min);
                $('#max').val(max);
            },
        });

        $('#slider-range').draggable();

        $('#min').change(function() {
            console.log('min change');
            const maxValue = Number($('#max').val()) || 500;
            const minValue = Number($('#min').val()) > maxValue ? maxValue : Number($('#min').val());
            $('#slider-range').slider('values', 0, minValue);

            const min = $('#slider-range').slider('values', 0);
            const max = $('#slider-range').slider('values', 1);
            $('#price-display').html(`${min} - ${max}`);
            $('#price').val(`${min}-${max}`);
            $('#min').val(min);
            $('#max').val(max);
        });

        $('#max').change(function() {
            const minValue = Number($('#min').val()) || 0;
            const maxValue = Number($('#max').val()) < minValue ? minValue : Number($('#max').val());
            $('#slider-range').slider('values', 1, maxValue);

            const min = $('#slider-range').slider('values', 0);
            const max = $('#slider-range').slider('values', 1);
            $('#price-display').html(`${min} - ${max}`);
            $('#price').val(`${min}-${max}`);
            $('#min').val(min);
            $('#max').val(max);
        });
    });
</script>

{{-- apply slider for price 2 --}}
<script>
    $(function() {
        $('#slider-range2').slider({
            range: true,
            min: 0,
            max: 500,
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

        $('#min2').change(function() {
            console.log('min change');
            const maxValue = Number($('#max2').val()) || 500;
            const minValue = Number($('#min2').val()) > maxValue ? maxValue : Number($('#min2').val());
            $('#slider-range2').slider('values', 0, minValue);

            const min = $('#slider-range2').slider('values', 0);
            const max = $('#slider-range2').slider('values', 1);
            $('#price-display2').html(`${min} - ${max}`);
            $('#price2').val(`${min}-${max}`);
            $('#min2').val(min);
            $('#max2').val(max);
        });

        $('#max2').change(function() {
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
    $(function() {
        $('.advanced-search-wrap').on('click', function() {
            $('.post-list-advanced-search').toggleClass('show');
        });
    });
</script>
