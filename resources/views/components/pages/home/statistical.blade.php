<div class="statistical section">
    <div class="svg-bg">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
            y="0px" width="100%" height="100%" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice">
            <defs>
                <linearGradient id="bg">
                    <stop offset="0%" style="stop-color:rgba(255, 255, 255, 0.6)"></stop>
                    <stop offset="50%" style="stop-color:rgba(255, 255, 255, 0.1)"></stop>
                    <stop offset="100%" style="stop-color:rgba(255, 255, 255, 0.6)"></stop>
                </linearGradient>
                <path id="wave" stroke="url(#bg)" fill="none"
                    d="M-363.852,502.589c0,0,236.988-41.997,505.475,0 s371.981,38.998,575.971,0s293.985-39.278,505.474,5.859s493.475,48.368,716.963-4.995v560.106H-363.852V502.589z">
                </path>
            </defs>
            <g>
                <use xlink:href="#wave">
                    <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="10s"
                        calcMode="spline" values="270 230; -334 180; 270 230" keyTimes="0; .5; 1"
                        keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0" repeatCount="indefinite"></animateTransform>
                </use>
                <use xlink:href="#wave">
                    <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="8s"
                        calcMode="spline" values="-270 230;243 220;-270 230" keyTimes="0; .6; 1"
                        keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0" repeatCount="indefinite"></animateTransform>
                </use>
                <use xlink:href="#wave">
                    <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="6s"
                        calcMode="spline" values="0 230;-140 200;0 230" keyTimes="0; .4; 1"
                        keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0" repeatCount="indefinite"></animateTransform>
                </use>
                <use xlink:href="#wave">
                    <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="12s"
                        calcMode="spline" values="0 240;140 200;0 230" keyTimes="0; .4; 1"
                        keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0" repeatCount="indefinite"></animateTransform>
                </use>
            </g>
        </svg>
    </div>
    <div class="container">
        <div class="item">
            <div class="counter" data-value="578"></div>
            <h6>...</h6>
            {{-- Agents and Agencys --}}
        </div>
        <div class="item">
            <div class="counter" data-value="12168"></div>
            <h6>...</h6>
            {{-- Happy customers every year --}}
        </div>
        <div class="item">
            <div class="counter" data-value="2172"></div>
            <h6>...</h6>
            {{-- Won Awards --}}
        </div>
        <div class="item">
            <div class="counter" data-value="732"></div>
            <h6>...</h6>
            {{-- New Listing Every Week --}}
        </div>
    </div>
</div>

<script>
    const options = {
        useEasing: true,
        useGrouping: true,
        separator: '',
    };

    function countStart() {
        const items = document.querySelectorAll('.statistical .item');
        for (let i = 0; i < items.length; i++) {
            const item = items[i].querySelector('div');
            const countValue = item.getAttribute('data-value');

            const countUP = new CountUp(item, 0, countValue, 0, 2, options);
            if (!countUP.error) {
                countUP.start();
            }
        }
    }

    ScrollReveal().reveal('.statistical', {
        beforeReveal: countStart,
        opacity: 1,
        scale: 1,
        distance: '0px'
    });
</script>
