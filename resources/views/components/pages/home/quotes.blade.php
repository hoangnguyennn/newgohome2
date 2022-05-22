<div class="quotes section">
    <div class="top">
        <h4 class="subtitle">TESTIMONILAS</h4>
        <h3 class="title">What Our Clients Say</h3>
    </div>
    <div class="bottom">
        <div class="quotes-wrap">
            <div class="quote-wrap">
                <div class="quote">
                    <div class="quote-header">
                        <div class="avatar">
                            <img src="{{ mix('images/webp/avatar-1.webp') }}" alt="" />
                        </div>
                        <div class="name">Antony Moore</div>
                    </div>
                    <div class="quote-body">
                        <p class="content">
                            “In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu
                            mi
                            magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing
                            elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat.”
                        </p>
                        <div>
                            <a href="#" class="ref">Via Facebook</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quote-wrap">
                <div class="quote">
                    <div class="quote-header">
                        <div class="avatar">
                            <img src="{{ mix('images/webp/avatar-2.webp') }}" alt="" />
                        </div>
                        <div class="name">Antony Moore</div>
                    </div>
                    <div class="quote-body">
                        <p class="content">
                            “In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu
                            mi
                            magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing
                            elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat.”
                        </p>
                        <div>
                            <a href="#" class="ref">Via Facebook</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quote-wrap">
                <div class="quote">
                    <div class="quote-header">
                        <div class="avatar">
                            <img src="{{ mix('images/webp/avatar-3.webp') }}" alt="" />
                        </div>
                        <div class="name">Antony Moore</div>
                    </div>
                    <div class="quote-body">
                        <p class="content">
                            “In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu
                            mi
                            magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing
                            elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat.”
                        </p>
                        <div>
                            <a href="#" class="ref">Via Facebook</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quote-wrap">
                <div class="quote">
                    <div class="quote-header">
                        <div class="avatar">
                            <img src="{{ mix('images/webp/avatar-4.webp') }}" alt="" />
                        </div>
                        <div class="name">Antony Moore</div>
                    </div>
                    <div class="quote-body">
                        <p class="content">
                            “In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu
                            mi
                            magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing
                            elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat.”
                        </p>
                        <div>
                            <a href="#" class="ref">Via Facebook</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            const mobileOptions = {
                prevArrow: false,
                nextArrow: false,
                dots: true,
                variableWidth: true,
                centerMode: true
            }

            const pcOptions = {
                ...mobileOptions,
                slidesToShow: 3,
                variableWidth: false,
                centerMode: false
            }

            function initSlick() {
                if ($(document).width() < 992) {
                    $('.quotes-wrap').slick(mobileOptions);
                } else {
                    $('.quotes-wrap').slick(pcOptions);
                }
            }

            initSlick();

            $(window).resize(function() {
                $('.quotes-wrap').slick('unslick');
                initSlick();
            });
        });
    </script>
</div>
