<div class="statistical section">
    <div class="container">
        <div class="item">
            <div class="counter" data-value="578"></div>
            <h6>Agents and Agencys</h6>
        </div>
        <div class="item">
            <div class="counter" data-value="12168"></div>
            <h6>Happy customers every year</h6>
        </div>
        <div class="item">
            <div class="counter" data-value="2172"></div>
            <h6>Won Awards</h6>
        </div>
        <div class="item">
            <div class="counter" data-value="732"></div>
            <h6>New Listing Every Week</h6>
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
        const items = document.querySelectorAll('.item');
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
