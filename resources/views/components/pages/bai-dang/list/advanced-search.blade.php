<div class="post-list-advanced-search">
    <div class="top">
        <h3 class="title">
            <i class="las la-sliders-h"></i>
            <span>Tìm kiếm nâng cao</span>
        </h3>
        <div class="close">
            <i class="las la-times"></i>
        </div>
    </div>

    <div class="center">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="acreage">Diện tích từ</label>
                    <input type="number" name="acreage" value="{{ request()->input('acreage') }}" id="acreage"
                        class="form-control" />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="bedroom">Số phòng ngủ</label>
                    <input type="number" name="bedroom" value="{{ request()->input('bedroom') }}" id="bedroom"
                        class="form-control" />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="toilet">Số phòng tắm</label>
                    <input type="number" name="toilet" value="{{ request()->input('toilet') }}" id="toilet"
                        class="form-control" />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="floor">Số tầng</label>
                    <input type="number" name="floor" value="{{ request()->input('floor') }}" id="floor"
                        class="form-control" />
                </div>
            </div>
        </div>
    </div>

    <div class="bottom">
        <div class="row">
            <div class="col">
                <button class="btn">Tìm kiếm</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.post-list-advanced-search .close').on('click', function() {
            $('.post-list-advanced-search').toggleClass('show');
        });
    });
</script>
