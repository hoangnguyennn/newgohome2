<article class="post post-{{ $post->id }}">
    <div class="post-thumb">
        @php
            if (count($post->images) !== 0) {
                $image = $post->images[0]->filename;
            } else {
                $image = '';
            }
        @endphp
        <div class="img-wrap">


            @foreach ($post->images as $image)
                @php
                    $isHide = $loop->index != 0;
                    $url = url('/uploads/' . $image->filename);
                @endphp
                <div class="{{ $isHide ? 'd-none' : '' }}" data-src="{{ $url }}">
                    <img src="{{ $url }}" alt="{{ $loop->index + 1 }}" height="280" loading="lazy" />
                    <div class="overlay"></div>
                </div>
            @endforeach

            @if ($post->video)
                <div class="d-none justify-content-center align-items-center"
                    data-video='{"source": [{"src":"{{ url('/uploads/' . $post->video->filename) }}", "type":"video/mp4"}], "attributes": {"preload": false, "playsinline": true, "controls": true}}'>
                    <a class="d-flex" class="gallery-item" href="{{ url('/uploads/' . $post->video->filename) }}">
                        <video height="280">
                            <source src="{{ url('/uploads/' . $post->video->filename) }}" type="video/mp4">
                        </video>
                    </a>
                </div>
            @endif
        </div>

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
            @php
                $postId = $post->category->shorthand . '-' . $post->id_by_category;
            @endphp
            <span>{{ $postId }}</span>
        </div>
    </div>
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
                    @php
                        $url = $post->user && $post->user->avatar ? url('/avatars/' . $post->user->avatar) : '';
                    @endphp
                    @if ($url)
                        <img src="{{ $url }}" alt="{{ $post->user->name }}" />
                    @else
                        <img src="{{ mix('images/default-avatar.jpg') }}" alt="" />
                    @endif
                </div>
                <p>{{ $post->user ? $post->user->fullname : '' }}</p>
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

    <script>
        $(function() {
            const container = document.querySelector('.post-{{ $post->id }} .img-wrap');
            lightGallery(container, {
                animateThumb: false,
                zoomFromOrigin: false,
                allowMediaOverlap: true,
                toggleThumb: true,
                controls: true,
                showCloseIcon: true,
                download: false,
                mobileSettings: {
                    controls: true,
                    showCloseIcon: true,
                    download: false
                },
                speed: 100,
                plugins: [lgRotate, lgVideo]
            });
        });
    </script>
</article>
