<form class="main-search search-form" action="{{ route('posts') }}" novalidate>
    <div class="search-body">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Nhập tên bất động sản cần tìm" name="q" />
        </div>
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

        <div class="form-group">
            <div class="form-control d-flex align-items-center" id="price-zone" type="button" data-toggle="dropdown"
                aria-expanded="false">
                <span>Giá (triệu đồng):&nbsp;</span>
                <div id="price-display" class="text-primary"></div>
                <input type="hidden" name="price" id="price" />
                <div class="dropdown-menu price-dropdown" aria-labelledby="price">
                    <div class="price-inputs">
                        <input type="number" class="form-control" id="min" min="0" max="100" />
                        <input type="number" class="form-control" id="max" min="0" max="100" />
                    </div>
                    <div id="slider-range"></div>
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
        $('#slider-range').slider({
            range: true,
            min: 0,
            max: 250,
            values: [0, 250],
            slide: function(event, ui) {
                const min = ui.values[0];
                const max = ui.values[1];
                $('#price-display').html(`${min} - ${max}`);
                $('#price').val(`${min}-${max}`);
                $('#min').val(min);
                $('#max').val(max);
            },
        });

        const min = $('#slider-range').slider('values', 0);
        const max = $('#slider-range').slider('values', 1);
        $('#price-display').html(`${min} - ${max}`);
        $('#price').val(`${min}-${max}`);
        $('#min').val(min);
        $('#max').val(max);

        $('#slider-range').draggable();

        $('#min').keyup(function() {
            const maxValue = Number($('#max').val()) || 250;
            const minValue = Number($('#min').val()) > maxValue ? maxValue : Number($('#min').val());
            $('#slider-range').slider('values', 0, minValue);

            const min = $('#slider-range').slider('values', 0);
            const max = $('#slider-range').slider('values', 1);
            $('#price-display').html(`${min} - ${max}`);
            $('#price').val(`${min}-${max}`);
            $('#min').val(min);
            $('#max').val(max);
        });

        $('#max').keyup(function() {
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
