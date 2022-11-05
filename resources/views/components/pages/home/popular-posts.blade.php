<div class="popular-posts section">
    <div class="container">
        <div class="top">
            <div class="section-title">
                <h3 class="subtitle">Khám phá</h3>
                <h4 class="title">Bất động sản cho bạn</h4>
            </div>

            <div class="filters">
                <a href="{{ route('home') }}" class="filter{{ ($type ?? 'all') == 'all' ? ' active' : '' }}">
                    Tất cả
                </a>
                <a href="{{ route('home', ['type' => 'cheap']) }}"
                    class="filter{{ ($type ?? 'all') == 'cheap' ? ' active' : '' }}">Giá rẻ</a>
                <a href="{{ route('home', ['type' => 'featured']) }}"
                    class="filter{{ ($type ?? 'all') == 'featured' ? ' active' : '' }}">Nổi bật</a>
            </div>
        </div>

        <div class="center post-list">
            <div class="row">
                @foreach ($posts as $post)
                    @php
                        if ($loop->index % 2 === 0) {
                            $rating = 5;
                        } else {
                            $rating = 4;
                        }
                    @endphp
                    <div class="col-12 col-md-6 col-lg-4">
                        @include('components.common.post', ['post' => $post, 'rating' => $rating])
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bottom view-all-list">
            <a href="{{ route('posts', ['type' => $type ?? 'all']) }}" class="btn-view-all-list">Xem tất cả</a>
        </div>
    </div>
</div>
