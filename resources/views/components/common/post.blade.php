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

        <div class="image-count">
            <i class="las la-camera"></i>
            <span>{{ count($post->images) }}</span>
        </div>
    </a>
    <div class="post-content">
        <h3 class="title">
            <a href="{{ route('post', $post->slug) }}">{{ $post->name }}</a>
        </h3>

        @php
            $currentPrice = ($post->price * (100 - $post->discount)) / 100;
            $oldPrice = $post->price;
        @endphp
        <div class="price currency">{{ $currentPrice }}</div>
        <div class="description">{{ $post->description }}</div>
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
        <div class="foot">
            <div class="author">
                <div class="avatar">
                    <img src="{{ mix('images/default-avatar.jpg') }}" alt="" />
                </div>
                <p>By {{ $post->user->fullname }}</p>
            </div>
            <div class="rating">
                @php
                    $rating = isset($rating) ? $rating : 5;
                @endphp
                @for ($i = 1; $i <= $rating; $i++)
                    <i class="las la-star"></i>
                @endfor

                @if ($rating < 5)
                    <i class="lar la-star"></i>
                @endif
            </div>
        </div>
    </div>
</article>
