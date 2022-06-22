<form class="advanced-search-modal modal fade" id="advanced-search-form" tabindex="-1" role="dialog"
    aria-labelledby="advanced-search-form-title" aria-hidden="true" action="{{ route('posts') }}" novalidate>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="advanced-search-form-title">Tìm kiếm nâng cao</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nhập tên bất động sản cần tìm"
                        name="q" />
                </div>

                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="form-group multiselect-location">
                            <select name="location[]" class="form-control" multiple="multiple">
                                @foreach ($wards as $ward)
                                    <option value="{{ $ward->id }}">{{ $ward->district->name }} -
                                        {{ $ward->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="form-group">
                            <select name="category[]" class="form-control" multiple>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <div class="form-control d-flex align-items-center" id="price-zone-2" type="button"
                                data-toggle="dropdown" aria-expanded="false">
                                <span>Giá (triệu đồng):&nbsp;</span>
                                <div id="price-display-2" class="text-primary"></div>
                                <input type="hidden" name="price" id="price-2" />
                                <div class="dropdown-menu price-dropdown" aria-labelledby="price">
                                    <div class="price-inputs">
                                        <input type="number" class="form-control" id="min-2" min="0"
                                            max="100" />
                                        <input type="number" class="form-control" id="max-2" min="0"
                                            max="100" />
                                    </div>
                                    <div id="slider-range-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="form-group">
                            <input type="number" min="0" class="form-control" placeholder="Diện tích từ"
                                name="acreage" />
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="form-group">
                            <input type="number" min="0" class="form-control" placeholder="Số phòng ngủ"
                                name="bedroom" />
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="form-group">
                            <input type="number" min="0" class="form-control" placeholder="Số phòng tắm"
                                name="toilet" />
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="form-group">
                            <input type="number" min="0" class="form-control" placeholder="Số tầng"
                                name="floor" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn">Tìm kiếm</button>
            </div>
        </div>
    </div>
</form>

{{-- apply slider for price --}}
<script>
    $(function() {
        $('#slider-range-2').slider({
            range: true,
            min: 0,
            max: 150,
            values: [0, 150],
            slide: function(event, ui) {
                const min = ui.values[0];
                const max = ui.values[1];
                $('#price-display-2').html(`${min} - ${max}`);
                $('#price-2').val(`${min}-${max}`);
                $('#min-2').val(min);
                $('#max-2').val(max);
            },
        });

        const min = $('#slider-range-2').slider('values', 0);
        const max = $('#slider-range-2').slider('values', 1);
        $('#price-display-2').html(`${min} - ${max}`);
        $('#price-2').val(`${min}-${max}`);
        $('#min-2').val(min);
        $('#max-2').val(max);

        $('#slider-range-2').draggable();

        $('#min-2').change(function() {
            console.log('min change');
            const maxValue = Number($('#max-2').val()) || 150;
            const minValue = Number($('#min-2').val()) > maxValue ? maxValue : Number($('#min').val());
            $('#slider-range-2').slider('values', 0, minValue);

            const min = $('#slider-range-2').slider('values', 0);
            const max = $('#slider-range-2').slider('values', 1);
            $('#price-display-2').html(`${min} - ${max}`);
            $('#price-2').val(`${min}-${max}`);
            $('#min-2').val(min);
            $('#max-2').val(max);
        });

        $('#max-2').change(function() {
            const minValue = Number($('#min-2').val()) || 0;
            const maxValue = Number($('#max-2').val()) < minValue ? minValue : Number($('#max').val());
            $('#slider-range-2').slider('values', 1, maxValue);

            const min = $('#slider-range-2').slider('values', 0);
            const max = $('#slider-range-2').slider('values', 1);
            $('#price-display-2').html(`${min} - ${max}`);
            $('#price-2').val(`${min}-${max}`);
            $('#min-2').val(min);
            $('#max-2').val(max);
        });
    });
</script>
