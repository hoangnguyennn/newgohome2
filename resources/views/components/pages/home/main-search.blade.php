<form class="main-search search-form" action="{{ route('posts') }}" novalidate>
    <div class="search-body">
        {{-- <div class="form-group">
            <input type="text" class="form-control" placeholder="Nhập tên bất động sản cần tìm" name="q" />
        </div> --}}
        <div class="form-group multiselect-location">
            @include('components.common.multiple-select', [
                'classes' => 'form-control',
                'name' => 'location[]',
                'items' => $wards->map(function ($item) {
                    $item->render_name = $item->district->name . ' - ' . $item->name;
                    return $item;
                }),
                'nonSelectedText' => 'Khu vực',
                'nSelectedText' => ' khu vực được chọn',
            ])
        </div>
        <div class="form-group category-wrap">
            @include('components.common.multiple-select', [
                'classes' => 'form-control',
                'name' => 'category[]',
                'items' => $categories->map(function ($item) {
                    $item->render_name = $item->name;
                    return $item;
                }),
                'nonSelectedText' => 'Loại nhà đất',
                'nSelectedText' => ' loại được chọn',
            ])
        </div>

        {{-- <div class="form-group duration-wrap">
            @include('components.common.multiple-select', [
                'classes' => 'form-control',
                'name' => 'duration[]',
                'items' => $durations->map(function ($item) {
                    $item->render_name = $item->name;
                    return $item;
                }),
                'nonSelectedText' => 'Thời hạn',
                'nSelectedText' => ' loại được chọn',
            ])
        </div> --}}

        <div class="form-group">
            <div class="form-control d-flex align-items-center price-zone" type="button" data-toggle="dropdown"
                aria-expanded="false">
                <span>Giá:&nbsp;</span>
                <div class="price-display"></div>
                <input type="hidden" name="price" class="price" />
                <div class="dropdown-menu price-dropdown" aria-labelledby="price">
                    <div class="price-inputs">
                        <input type="number" class="form-control min" />
                        <input type="number" class="form-control max" />
                    </div>
                    <div class="slider-range"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group submit-wrap">
        <button type="submit" class="btn form-control">
            <span>Tìm kiếm</span>
            <i class="las la-search rotate-270"></i>
        </button>
    </div>
</form>

<div class="search-form-notifer">
    Cần thêm lựa chọn tìm kiếm?
    <button class="btn" data-toggle="modal" data-target="#advanced-search-form">Tìm kiếm nâng cao</button>
</div>

{{-- apply slider for price --}}
<script>
    $(function() {
        const mainSearch = '.main-search';
        const priceZone = '.price-zone';
        const sliderRange = '.slider-range';
        const priceDisplay = '.price-display';
        const price = '.price';
        const maxEl = '.max';
        const minEl = '.min';

        $(`${mainSearch} ${sliderRange}`).slider({
            range: true,
            min: 0,
            max: 250,
            values: [0, 250],
            slide: function(event, ui) {
                const min = ui.values[0];
                const max = ui.values[1];
                $(`${mainSearch} ${priceDisplay}`).html(`${min} - ${max}`);
                $(`${mainSearch} ${price}`).val(`${min}-${max}`);
                $(`${mainSearch} ${minEl}`).val(min);
                $(`${mainSearch} ${maxEl}`).val(max);
            },
        });

        const min = $(`${mainSearch} ${sliderRange}`).slider('values', 0);
        const max = $(`${mainSearch} ${sliderRange}`).slider('values', 1);
        $(`${mainSearch} ${priceDisplay}`).html(`${min} - ${max}`);
        $(`${mainSearch} ${price}`).val(`${min}-${max}`);
        $(`${mainSearch} ${minEl}`).val(min);
        $(`${mainSearch} ${maxEl}`).val(max);

        $(`${mainSearch} ${sliderRange}`).draggable();

        $(`${mainSearch} ${minEl}`).on('change', function() {
            const maxValue = Number($(`${mainSearch} ${maxEl}`).val()) || 250;
            const minValue = Number($(`${mainSearch} ${minEl}`).val()) > maxValue ? maxValue : Number($(
                `${mainSearch} ${minEl}`).val());
            $(`${mainSearch} ${sliderRange}`).slider('values', 0, minValue);
            const min = $(`${mainSearch} ${sliderRange}`).slider('values', 0);
            const max = $(`${mainSearch} ${sliderRange}`).slider('values', 1);
            $(`${mainSearch} ${priceDisplay}`).html(`${min} - ${max}`);
            $(`${mainSearch} ${price}`).val(`${min}-${max}`);
            $(`${mainSearch} ${minEl}`).val(min);
            $(`${mainSearch} ${maxEl}`).val(max);
        });

        $(`${mainSearch} ${maxEl}`).on('change', function() {
            const minValue = Number($(`${mainSearch} ${minEl}`).val()) || 0;
            const maxValue = Number($(`${mainSearch} ${maxEl}`).val()) < minValue ? minValue : Number($(
                `${mainSearch} ${maxEl}`).val());
            $(`${mainSearch} ${sliderRange}`).slider('values', 1, maxValue);
            const min = $(`${mainSearch} ${sliderRange}`).slider('values', 0);
            const max = $(`${mainSearch} ${sliderRange}`).slider('values', 1);
            $(`${mainSearch} ${priceDisplay}`).html(`${min} - ${max}`);
            $(`${mainSearch} ${price}`).val(`${min}-${max}`);
            $(`${mainSearch} ${minEl}`).val(min);
            $(`${mainSearch} ${maxEl}`).val(max);
        });

        let focusEl = null;
        $(`${minEl}, ${maxEl}`).on('focus', function() {
            focusEl = $(this);
        });

        $(`${mainSearch}`).on('submit', function() {
            if (focusEl) {
                const isSafari = navigator.userAgent.indexOf('Safari') > -1;
                const isChrome = navigator.userAgent.indexOf('Chrome') > -1;

                if (isSafari) {
                    if (!isChrome) {
                        const e = new Event('change');
                        focusEl.dispatchEvent(e);
                    }
                }
            }
        });
    });
</script>
