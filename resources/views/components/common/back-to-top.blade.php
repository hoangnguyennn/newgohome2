<button class="back-to-top">
    <i class="las la-caret-up"></i>
</button>

<script>
    $('.back-to-top').on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500, 'linear');
        return false;
    });
</script>
