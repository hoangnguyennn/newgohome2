<form class="main-search search-form" novalidate>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Nhập tên bất động sản cần tìm" name="q" />
    </div>
    <div class="form-group multiselect-localtion">
        <select id="location" name="location[]" class="form-control" multiple="multiple">
            <option value="">Khu vực</option>
        </select>
    </div>
    <div class="form-group">
        <select id="category" name="category" class="form-control">
            <option value="">Loại nhà đất</option>
        </select>
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
    <div class="collapse" id="advanceSearch">
        <div class="form-group">
            <input type="number" min="0" class="form-control" placeholder="Diện tích từ" name="acreage" />
        </div>
        <div class="form-group">
            <input type="number" min="0" class="form-control" placeholder="Số phòng ngủ" name="bedroom" />
        </div>
        <div class="form-group">
            <input type="number" min="0" class="form-control" placeholder="Số phòng tắm" name="toilet" />
        </div>
        <div class="form-group">
            <input type="number" min="0" class="form-control" placeholder="Số tầng" name="floor" />
        </div>
    </div>
    <div class="form-group d-flex">
        <span data-toggle="collapse" data-target="#advanceSearch" aria-expanded="false" aria-controls="advanceSearch">
            <i class="las la-filter size-19"></i>
            <span class="show-text">Mở rộng</span>
            <span class="hide-text">Thu gọn</span>
        </span>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-control">
            <span>Tìm kiếm</span>
            <i class="las la-search rotate-270"></i>
        </button>
    </div>
</form>

{{-- apply bootstrap multiselect for location --}}
<script>
    $('[name="location[]"]').each(function() {
        $(this).multiselect({
            widthSynchronizationMode: 'ifPopupIsSmaller',
            maxHeight: 400,
            nonSelectedText: 'Khu vực',
            nSelectedText: ' khu vực được chọn',
            buttonTitle: function(options, select) {
                let labels = [];
                options.each(function() {
                    labels.push($(this).text().trim());
                });
                return labels.join(', ');
            }
        });
    });

    $('.multiselect-localtion .btn-group').css('width', '100%');
    $('.multiselect').addClass('form-control text-left');
    $('.multiselect').removeClass('text-center');
</script>

{{-- remove non-value fields before submit --}}
<script>
    $('.search-form').each(function() {
        $(this).submit(function() {
            $(':input', this).each(function() {
                this.disabled = !($(this).val());
            });
        });
    });
</script>

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
