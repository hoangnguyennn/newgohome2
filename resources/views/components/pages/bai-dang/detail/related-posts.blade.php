<div class="related-posts">
    <h3 class="title">Bất động sản liên quan</h3>
    <div class="content">
        <div class="content-slider">
            @foreach ($relatedPosts as $post)
                @include('components.common.post', ['post' => $post])
            @endforeach
        </div>
        <div class="slider-control prev">
            <i class="las la-angle-down"></i>
        </div>
        <div class="slider-control next">
            <i class="las la-angle-down"></i>
        </div>
    </div>
</div>

<script>
    const mobileOptions = {
        prevArrow: false,
        nextArrow: false,
        dots: true,
    }

    const pcOptions = {
        ...mobileOptions,
        prevArrow: $('.slider-control.prev'),
        nextArrow: $('.slider-control.next'),
        slidesToShow: 3,
    }

    function initSlick() {
        if ($(document).width() < 992) {
            $('.content-slider').slick(mobileOptions);
        } else {
            $('.content-slider').slick(pcOptions);
        }
    }

    initSlick();

    $(window).resize(function() {
        $('.content-slider').slick('unslick');
        initSlick();
    });
</script>
