<header class="header">
    <div class="logo">
        <a href="#">
            <img src="{{ mix('images/logo.png') }}" alt="" />
        </a>
    </div>

    <div class="menu-toggle">
        <div class="icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="main-menu">
        <a href="#" class="add-listing" data-toggle="modal" data-target="#login-register-form">Add
            listing</a>
    </div>
</header>

<script>
    $('.menu-toggle').on('click', function() {
        $('.main-menu').toggleClass('show');
    });

    $(function() {
        $('.add-listing').click();
    });
</script>
