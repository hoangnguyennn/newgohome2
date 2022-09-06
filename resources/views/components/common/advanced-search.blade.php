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
                {{-- <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nhập tên bất động sản cần tìm"
                        name="q" />
                </div> --}}

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
                                'nonSelectedText' => 'Loại nhà đất',
                                'nSelectedText' => ' loại được chọn',
                            ])
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <div class="form-control d-flex align-items-center price-zone" type="button"
                                data-toggle="dropdown" aria-expanded="false">
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
                    {{-- <div class="col-12 col-lg-3">
                        <div class="form-group duration-wrap">
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
                        </div>
                    </div> --}}
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
        const advancedSearch = '.advanced-search-modal';
        const priceZone = '.price-zone';
        const sliderRange = '.slider-range';
        const priceDisplay = '.price-display';
        const price = '.price';
        const maxEl = '.max';
        const minEl = '.min';

        $(`${advancedSearch} ${sliderRange}`).slider({
            range: true,
            min: 0,
            max: 250,
            values: [0, 250],
            slide: function(event, ui) {
                const min = ui.values[0];
                const max = ui.values[1];
                $(`${advancedSearch} ${priceDisplay}`).html(`${min} - ${max}`);
                $(`${advancedSearch} ${price}`).val(`${min}-${max}`);
                $(`${advancedSearch} ${minEl}`).val(min);
                $(`${advancedSearch} ${maxEl}`).val(max);
            },
        });

        const min = $(`${advancedSearch} ${sliderRange}`).slider('values', 0);
        const max = $(`${advancedSearch} ${sliderRange}`).slider('values', 1);
        $(`${advancedSearch} ${priceDisplay}`).html(`${min} - ${max}`);
        $(`${advancedSearch} ${price}`).val(`${min}-${max}`);
        $(`${advancedSearch} ${minEl}`).val(min);
        $(`${advancedSearch} ${maxEl}`).val(max);

        $(`${advancedSearch} ${sliderRange}`).draggable();

        $(`${advancedSearch} ${minEl}`).on('change', function() {
            const maxValue = Number($(`${advancedSearch} ${maxEl}`).val()) || 250;
            const minValue = Number($(`${advancedSearch} ${minEl}`).val()) > maxValue ? maxValue :
                Number($(
                    `${advancedSearch} ${minEl}`).val());
            $(`${advancedSearch} ${sliderRange}`).slider('values', 0, minValue);
            const min = $(`${advancedSearch} ${sliderRange}`).slider('values', 0);
            const max = $(`${advancedSearch} ${sliderRange}`).slider('values', 1);
            $(`${advancedSearch} ${priceDisplay}`).html(`${min} - ${max}`);
            $(`${advancedSearch} ${price}`).val(`${min}-${max}`);
            $(`${advancedSearch} ${minEl}`).val(min);
            $(`${advancedSearch} ${maxEl}`).val(max);
        });

        $(`${advancedSearch} ${maxEl}`).on('change', function() {
            const minValue = Number($(`${advancedSearch} ${minEl}`).val()) || 0;
            const maxValue = Number($(`${advancedSearch} ${maxEl}`).val()) < minValue ? minValue :
                Number($(
                    `${advancedSearch} ${maxEl}`).val());
            $(`${advancedSearch} ${sliderRange}`).slider('values', 1, maxValue);
            const min = $(`${advancedSearch} ${sliderRange}`).slider('values', 0);
            const max = $(`${advancedSearch} ${sliderRange}`).slider('values', 1);
            $(`${advancedSearch} ${priceDisplay}`).html(`${min} - ${max}`);
            $(`${advancedSearch} ${price}`).val(`${min}-${max}`);
            $(`${advancedSearch} ${minEl}`).val(min);
            $(`${advancedSearch} ${maxEl}`).val(max);
        });

        let focusEl = null;
        $(`${minEl}, ${maxEl}`).on('focus', function() {
            focusEl = $(this);
        });

        $(`${advancedSearch}`).on('submit', function() {
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
