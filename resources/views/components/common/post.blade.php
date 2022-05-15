<article class="post">
    <a href="{{ route('post', $post->slug) }}" class="post-thumb">
        @php
            if (count($post->images) !== 0) {
                $image = $post->images[0]->filename;
            } else {
                $image = '';
            }
        @endphp
        <img src="{{ url('/uploads/' . $image) }}" alt="{{ $post->name }}" loading="lazy" />
        <div class="overlay"></div>

        <div class="post-location">
            <i class="las la-map-marker"></i>
            <span>{{ $post->ward->name }}, {{ $post->ward->district->name }}</span>
        </div>

        @if ($post->is_featured)
            <div class="post-labels is-featured">
                <div class="label">Nổi bật</div>
            </div>
        @endif

        <div class="post-labels">
            <div class="label">{{ $post->category->name }}</div>

            @if ($post->is_cheap)
                <div class="label">Giá rẻ</div>
            @endif
        </div>
    </a>
    <div class="post-content">
        <h3 class="title">{{ $post->name }}</h3>

        @php
            $currentPrice = ($post->price * (100 - $post->discount)) / 100;
            $oldPrice = $post->price;
        @endphp
        <div class="price currency">{{ ($post->price * (100 - $post->discount)) / 100 }}</div>

        <div class="description">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque.
            Nulla finibus lobortis pulvinar. Donec a consectetur nulla.
        </div>
        <div class="divider"></div>
        <ul class="convenient">
            @if ($post->bedroom)
                <li title="Phòng ngủ">
                    <i class="las la-bed"></i>
                    <span>{{ $post->bedroom }}</span>
                </li>
            @endif

            @if ($post->toilet)
                <li title="Nhà vệ sinh">
                    <i class="las la-bath"></i>
                    <span>{{ $post->toilet }}</span>
                </li>
            @endif

            @if ($post->floor)
                <li title="Số tầng">
                    <i class="las la-layer-group"></i>
                    <span>{{ $post->floor }}</span>
                </li>
            @endif

            <li title="Diện tích">
                <i class="las la-cube"></i>
                <span>{{ (int) $post->acreage }}</span>
            </li>

            @if ($post->updated_at)
                @php
                    $updated_at = $post->updated_at;
                    $updated_at->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
                @endphp
                <li title="Ngày đăng">
                    <i class="las la-calendar"></i>
                    <span>{{ $updated_at->format('d/m/Y') }}</span>
                </li>
            @endif

        </ul>
    </div>
</article>
