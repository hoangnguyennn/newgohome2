<div class="hero-section">
    <div class="bg">
        <div class="bg-slider">
            @foreach ($post->images as $image)
                <div class="img" style="background-image: url({{ url('/uploads/' . $image->filename) }});">
                </div>
                <div class="img"
                    style="background-image: url('https://homeradar.cththemes.co/wp-content/uploads/2021/04/1.jpg');">
                </div>
            @endforeach
        </div>
    </div>

    <div class="container">
        <div class="labels">
            <div class="label">{{ $post->category->name }}</div>
        </div>

        <h1 class="title">{{ $post->name }}</h1>

        <div class="foot">
            <div class="left">
                <div class="price-wrap">
                    @php
                        $currentPrice = ($post->price * (100 - $post->discount)) / 100;
                        $oldPrice = $post->price;
                    @endphp
                    <strong>Giá: </strong>
                    <div class="price currency">{{ $currentPrice }}</div>
                </div>

                <div class="date-wrap">
                    @php
                        $updated_at = $post->updated_at;
                        $updated_at->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
                    @endphp
                    <strong>Ngày đăng: </strong>
                    <div class="date">{{ $updated_at->format('d/m/Y') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        const mobileOptions = {
            prevArrow: false,
            nextArrow: false,
            // dots: true,
            autoplay: true,
            autoplaySpeed: 5000,
            fade: true,
        }

        const pcOptions = {
            ...mobileOptions,
            // slidesToShow: 3,
        }

        function initSlick() {
            if ($(document).width() < 992) {
                $('.bg-slider').slick(mobileOptions);
            } else {
                $('.bg-slider').slick(pcOptions);
            }
        }

        initSlick();

        $(window).resize(function() {
            $('.bg-slider').slick('unslick');
            initSlick();
        });
    });
</script>
