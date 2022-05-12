<div class="popular-cities">
    <div class="top">
        <h2 class="title">Explore Best Cities</h2>
        <p class="description">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua.
        </p>
    </div>
    <div class="bottom">
        <div class="popular-cities-slider">
            <div class="city">
                <div class="img-wrap" style="background-image: url({{ mix('images/slider-1-image.jpg') }});">
                </div>
                <div class="content">
                    <div class="property-count">
                        <span>3</span> properties
                    </div>
                    <h3 class="title">Rome</h3>
                    <p class="description">Constant care and attention to the patients makes good record</p>
                </div>
            </div>
            <div class="city">
                <div class="img-wrap" style="background-image: url({{ mix('images/slider-2-image.jpg') }});">
                </div>
                <div class="content">
                    <div class="property-count">
                        <span>3</span> properties
                    </div>
                    <h3 class="title">Paris</h3>
                    <p class="description">Constant care and attention to the patients makes good record</p>
                </div>
            </div>
            <div class="city">
                <div class="img-wrap" style="background-image: url({{ mix('images/slider-3-image.jpg') }});">
                </div>
                <div class="content">
                    <div class="property-count">
                        <span>3</span> properties
                    </div>
                    <h3 class="title">New York</h3>
                    <p class="description">Constant care and attention to the patients makes good record</p>
                </div>
            </div>
            <div class="city">
                <div class="img-wrap" style="background-image: url({{ mix('images/slider-4-image.jpg') }});">
                </div>
                <div class="content">
                    <div class="property-count">
                        <span>3</span> properties
                    </div>
                    <h3 class="title">Moscow</h3>
                    <p class="description">Constant care and attention to the patients makes good record</p>
                </div>
            </div>
            <div class="city">
                <div class="img-wrap" style="background-image: url({{ mix('images/slider-5-image.jpg') }});">
                </div>
                <div class="content">
                    <div class="property-count">
                        <span>3</span> properties
                    </div>
                    <h3 class="title">London</h3>
                    <p class="description">Constant care and attention to the patients makes good record</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.popular-cities-slider').slick({
                prevArrow: false,
                nextArrow: false,
                dots: true
            });
        });
    </script>
</div>
