<form class="main-search search-form" action="{{ route('posts') }}" novalidate>
    <div class="search-body">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Nhập tên bất động sản cần tìm" name="q" />
        </div>
        <div class="form-group multiselect-location">
            <select id="location" name="location[]" class="form-control" multiple="multiple">
                @foreach ($wards as $ward)
                    <option value="{{ $ward->id }}">{{ $ward->district->name }} - {{ $ward->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group category-wrap">
            <select id="category" name="category" class="form-control">
                <option value="">Loại nhà đất</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn form-control">
            {{-- <span>Tìm kiếm</span> --}}
            <i class="las la-search rotate-270"></i>
        </button>
    </div>
</form>

<div class="search-form-notifer">
    Cần thêm lựa chọn tìm kiếm?
    <button class="btn" data-toggle="modal" data-target="#advanced-search-form">Tìm kiếm nâng cao</button>
</div>

<script>
    $(function() {
        $('#category').niceSelect();
    });
</script>
