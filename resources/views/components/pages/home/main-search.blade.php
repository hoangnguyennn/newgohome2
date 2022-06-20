<form class="main-search search-form" action="{{ route('posts') }}" novalidate>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Nhập tên bất động sản cần tìm" name="q" />
    </div>

    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="form-group multiselect-localtion">
                <select id="location" name="location[]" class="form-control" multiple="multiple">
                    @foreach ($wards as $ward)
                        <option value="{{ $ward->id }}">{{ $ward->district->name }} - {{ $ward->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="form-group">
                <select id="category" name="category" class="form-control">
                    <option value="">Loại nhà đất</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <div class="form-control d-flex align-items-center" id="price-zone" type="button"
                    data-toggle="dropdown" aria-expanded="false">
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
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary form-control">
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
            max: 500,
            values: [0, 500],
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
