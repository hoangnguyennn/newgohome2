<div class="meet-our-agents section">
    <div class="container">
        <div class="top">
            <h4 class="subtitle">THE BEST AGENTS</h4>
            <h3 class="title">Meet Our Agents</h3>
        </div>
        <div class="bottom">
            <div class="meet-our-agents-slider">
                <div class="agent">
                    <div class="img-wrap">
                        <img src="{{ mix('images/webp/agent-1.webp') }}" alt="" />
                    </div>
                    <div class="content">
                        <h4 class="title">Liza Rose</h4>
                        <h5 class="agency">Mavers RealEstate Agency</h5>
                        <p class="description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla
                            finibus lobortis pulvinar. Donec a consectetur nulla.
                        </p>
                        <div class="foot">
                            <a href="#">View Profile</a>
                        </div>
                    </div>
                </div>
                <div class="agent">
                    <div class="img-wrap">
                        <img src="{{ mix('images/webp/agent-2.webp') }}" alt="" />
                    </div>
                    <div class="content">
                        <h4 class="title">Liza Rose</h4>
                        <h5 class="agency">Mavers RealEstate Agency</h5>
                        <p class="description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla
                            finibus lobortis pulvinar. Donec a consectetur nulla.
                        </p>
                        <div class="foot">
                            <a href="#">View Profile</a>
                        </div>
                    </div>
                </div>
                <div class="agent">
                    <div class="img-wrap">
                        <img src="{{ mix('images/webp/agent-3.webp') }}" alt="" />
                    </div>
                    <div class="content">
                        <h4 class="title">Liza Rose</h4>
                        <h5 class="agency">Mavers RealEstate Agency</h5>
                        <p class="description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla
                            finibus lobortis pulvinar. Donec a consectetur nulla.
                        </p>
                        <div class="foot">
                            <a href="#">View Profile</a>
                        </div>
                    </div>
                </div>
                <div class="agent">
                    <div class="img-wrap">
                        <img src="{{ mix('images/webp/agent-4.webp') }}" alt="" />
                    </div>
                    <div class="content">
                        <h4 class="title">Liza Rose</h4>
                        <h5 class="agency">Mavers RealEstate Agency</h5>
                        <p class="description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla
                            finibus lobortis pulvinar. Donec a consectetur nulla.
                        </p>
                        <div class="foot">
                            <a href="#">View Profile</a>
                        </div>
                    </div>
                </div>
                <div class="agent">
                    <div class="img-wrap">
                        <img src="{{ mix('images/webp/agent-5.webp') }}" alt="" />
                    </div>
                    <div class="content">
                        <h4 class="title">Liza Rose</h4>
                        <h5 class="agency">Mavers RealEstate Agency</h5>
                        <p class="description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla
                            finibus lobortis pulvinar. Donec a consectetur nulla.
                        </p>
                        <div class="foot">
                            <a href="#">View Profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-control prev">
                <i class="las la-angle-down"></i>
            </div>
            <div class="slider-control next">
                <i class="las la-angle-down"></i>
            </div>
        </div>
        <script>
            $(function() {
                const mobileOptions = {
                    prevArrow: false,
                    nextArrow: false,
                    dots: true,
                }

                const pcOptions = {
                    prevArrow: $('.slider-control.prev'),
                    nextArrow: $('.slider-control.next'),
                    dots: true,
                    slidesToShow: 3
                }

                function initSlick() {
                    if ($(document).width() < 992) {
                        $('.meet-our-agents-slider').slick(mobileOptions);
                    } else {
                        $('.meet-our-agents-slider').slick(pcOptions);
                    }
                }

                initSlick();

                $(window).resize(function() {
                    console.log('resize');
                    $('.meet-our-agents-slider').slick('unslick');
                    initSlick();
                });
            });
        </script>
    </div>
</div>
