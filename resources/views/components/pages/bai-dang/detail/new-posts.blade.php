<div class="new-posts">
    <h3 class="title">Bất động sản mới</h3>
    <div class="content">
        @foreach ($latestPosts as $post)
            <a class="post" href="{{ route('post', $post->slug) }}">
                <div class="post-thumbnail">
                    @php
                        if (count($post->images) !== 0) {
                            $image = $post->images[0]->filename;
                        } else {
                            $image = '';
                        }
                    @endphp
                    <img src="{{ url('/uploads/' . $image) }}" alt="" loading="lazy" />
                    {{-- <div class="overlay"></div> --}}
                </div>

                <div class="post-content">
                    <div class="post-title">
                        <h3 title="{{ $post->name }}">{{ $post->name }}</h3>
                    </div>

                    <div class="post-address">
                        <i class="las la-map-marker"></i>
                        <span>{{ $post->ward->name }}, {{ $post->ward->district->name }}</span>
                    </div>

                    <div class="post-price">
                        <span class="price-label">Giá: </span>
                        <span class="currency">{{ $post->price }}</span>
                    </div>
                </div>
            </a>
        @endforeach

        <div class="view-all">
            <a href="{{ route('posts') }}" class="btn-view-all">Xem tất cả</a>
        </div>
    </div>
</div>
