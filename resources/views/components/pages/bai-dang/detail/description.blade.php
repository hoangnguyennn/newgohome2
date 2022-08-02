@if (Auth::check())
    <button class="btn my-4 download-images loading">
        Tải tất cả ảnh
        <i class="fas fa-spinner"></i>
    </button>

    <script>
        $(function() {
            const btnDownloadImages = document.querySelector('.download-images');
            let isFetching = false;
            btnDownloadImages.addEventListener('click', downloadImages);

            function downloadImages() {
                if (isFetching) {
                    return;
                }
                isFetching = true;
                btnDownloadImages.classList.add('show');
                btnDownloadImages.classList.add('disabled');
                const url = "{{ route('api.posts.download', $post->id) }}";
                axios
                    .get(url, {
                        responseType: 'blob'
                    })
                    .then((res) => {
                        let filename = '';
                        const disposition = res.headers['content-disposition'];
                        if (disposition) {
                            const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                            const matches = filenameRegex.exec(disposition);
                            if (matches != null && matches[1]) {
                                filename = matches[1].replace(/['"]/g, '');
                            }
                        }
                        const data = res.data;
                        const anchor = document.createElement('a');
                        anchor.href = URL.createObjectURL(data);
                        anchor.download = filename || 'download.zip';
                        anchor.click();
                        anchor.remove();
                        btnDownloadImages.classList.remove('show');
                        btnDownloadImages.classList.remove('disabled');
                    })
                    .finally(() => (isFetching = false));
            }
        });
    </script>
@endif
<div class="post-description">
    <div class="wrapper">
        <div class="title">Mô tả</div>
        @php
            $strpos = strpos($post->description, PHP_EOL);
            if ($strpos == false) {
                // does not contain PHP_EOL (php end of line)
                $substr1 = '';
                $substr2 = $post->description;
                $postId = 'Mã nhà: ' . $post->category->shorthand . '-' . $post->id_by_category . PHP_EOL;
            } else {
                $substr1 = substr($post->description, 0, $strpos);
                $substr2 = substr($post->description, $strpos + strlen(PHP_EOL));
                $postId = 'Mã nhà: ' . $post->category->shorthand . '-' . $post->id_by_category . PHP_EOL;
            }
        @endphp
        <p class="content des">{{ $substr1 }}{{ $postId }}{{ $substr2 }}</p>
    </div>

    <div class="wrapper">
        <div class="title">Chi tiết</div>
        <div class="row detail">
            <div class="col-12 col-lg-6">
                <b>Khu vực: </b>
                <span>{{ $post->ward->type->name }} {{ $post->ward->name }}</span>
            </div class="col-12 col-lg-6">

            <div class="col-12 col-lg-6">
                <b>Giá cả: </b>
                <span class="currency">
                    {{ ($post->price * (100 - $post->discount)) / 100 }}
                </span>
            </div class="col-12 col-lg-6">

            <div class="col-12 col-lg-6">
                <b>Diện tích: </b>
                <span>{{ (int) $post->acreage }} m2</span>
            </div class="col-12 col-lg-6">

            @if ($post->floor)
                <div class="col-12 col-lg-6">
                    <b>Số tầng: </b>
                    <span>{{ $post->floor }} tầng</span>
                </div class="col-12 col-lg-6">
            @endif

            @if ($post->bedroom)
                <div class="col-12 col-lg-6">
                    <b>Số phòng ngủ: </b>
                    <span>{{ $post->bedroom }} phòng</span>
                </div class="col-12 col-lg-6">
            @endif

            @if ($post->toilet)
                <div class="col-12 col-lg-6">
                    <b>Số phòng tắm: </b>
                    <span>{{ $post->toilet }} phòng</span>
                </div class="col-12 col-lg-6">
            @endif

            <div class="col-12 col-lg-6">
                <b>Loại: </b>
                <span>{{ $post->category->name }}</span>
            </div class="col-12 col-lg-6">

            @if (Auth::check())
                @if (Auth::user()->isAdmin())
                    <div class="col-12 col-lg-6">
                        <b>Họ tên chủ nhà: </b>
                        <span>{{ $post->owner_name }}</span>
                    </div class="col-12 col-lg-6">

                    <div class="col-12 col-lg-6">
                        <b>Địa chỉ chủ nhà: </b>
                        <span>{{ $post->owner_address }}</span>
                    </div class="col-12 col-lg-6">

                    <div class="col-12 col-lg-6">
                        <b>Số điện thoại chủ nhà: </b>
                        <span>{{ $post->owner_phone }}</span>
                    </div class="col-12 col-lg-6">

                    <div class="col-12 col-lg-6">
                        <b>Hoa hồng: </b>
                        <span class="currency" title="{{ $post->commission }}">{{ $post->commission }}</span>
                    </div class="col-12 col-lg-6">
                @endif
            @endif

            <div class="col-12 col-lg-6">
                <b>Người đăng: </b>
                <span>{{ $post->user ? $post->user->fullname : '' }}</span>
            </div class="col-12 col-lg-6">
        </div>
    </div>
</div>
