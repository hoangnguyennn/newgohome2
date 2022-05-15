<div class="popular-posts section">
    <div class="container">
        <div class="top">
            <div class="section-title">
                <h4 class="subtitle">Khám phá</h4>
                <h3 class="title">Bất động sản cho bạn</h3>
            </div>

            <div class="filters">
                <a href="{{ route('home') }}" class="filter{{ ($category ?? 'all') == 'all' ? ' active' : '' }}">Tất
                    cả</a>
                <a href="{{ route('home', ['category' => 'cheap']) }}"
                    class="filter{{ ($category ?? 'all') == 'cheap' ? ' active' : '' }}">Giá rẻ</a>
                <a href="{{ route('home', ['category' => 'featured']) }}"
                    class="filter{{ ($category ?? 'all') == 'featured' ? ' active' : '' }}">Nổi bật</a>
            </div>
        </div>

        <div class="center post-list">
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-12 col-md-6 col-lg-4">
                        @include('components.common.post', ['post' => $post])
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bottom view-all-list">
            <a href="{{ route('posts') }}" class="btn-view-all-list">Xem tất cả</a>
        </div>
    </div>
</div>
