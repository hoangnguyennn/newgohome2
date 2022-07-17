<article class="post post-{{ $post->id }}">
    <div class="post-thumb" data-toggle="modal" data-target="#post-modal-{{ $post->id }}" tabindex="-1">
        @php
            if (count($post->images) !== 0) {
                $image = $post->images[0]->filename;
            } else {
                $image = '';
            }
        @endphp
        <img src="{{ url('/uploads/' . $image) }}" alt="{{ $post->name }}" height="280" loading="lazy" />
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
                    <img src="{{ mix('images/default-avatar.jpg') }}" alt="" />
                </div>
                <p>{{ $post->user->fullname }}</p>
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
    <div class="modal fade" id="post-modal-{{ $post->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" style="min-height: 80vh;"></div>
            </div>
        </div>
    </div>

    @php
        $images = $post->images
            ->map(function ($image) {
                $img = $image->filename;
                return [
                    'src' => url('/uploads/' . $img),
                    'responsive' => url('/uploads/' . $img),
                    'thumb' => url('/uploads/' . $img),
                ];
            })
            ->toArray();
    @endphp

    <script>
        $(function() {
            const container = document.querySelector('#post-modal-{{ $post->id }} .modal-body');

            const inlineGallery = lightGallery(container, {
                container: container,
                dynamic: true,
                // Turn off hash plugin in case if you are using it
                // as we don't want to change the url on slide change
                hash: false,
                // Do not allow users to close the gallery
                // closable: false,
                // Add maximize icon to enlarge the gallery
                showMaximizeIcon: true,
                // Append caption inside the slide item
                // to apply some animation for the captions (Optional)
                appendSubHtmlTo: '.lg-item',
                // Delay slide transition to complete captions animations
                // before navigating to different slides (Optional)
                // You can find caption animation demo on the captions demo page
                slideDelay: 400,
                dynamicEl: JSON.parse('<?php echo json_encode($images); ?>'),

                // Completely optional
                // Adding as the codepen preview is usually smaller
                // thumbWidth: 60,
                // thumbHeight: "40px",
                // thumbMargin: 4
                controls: true,
                showCloseIcon: true,
                download: false,
                mobileSettings: {
                    controls: true,
                    showCloseIcon: true,
                    download: false,
                },
                plugins: [lgRotate],
            });

            const modal = $('#post-modal-{{ $post->id }}');
            container.addEventListener('lgBeforeClose', () => {
                modal.modal('hide');
                document.body.style.overflow = 'auto';
            });

            modal.on('show.bs.modal', function(e) {
                inlineGallery.openGallery();
                document.body.style.overflow = 'hidden';
            });
        });
    </script>
</article>
