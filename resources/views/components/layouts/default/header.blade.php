<header class="header">
    <div class="logo">
        <a href="{{ route('home') }}" title="GoHome's logo">
            <img src="{{ mix('images/logo.png') }}" alt="" />
        </a>
    </div>

    <div class="right">
        <a href="#" class="login-toggler" data-toggle="modal" data-target="#login-register-form"
            title="Open the login form">
            <i class="lar la-user"></i>
        </a>

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
    </div>
</header>

<script>
    $('.menu-toggle').on('click', function() {
        $('.main-menu').toggleClass('show');
    });
</script>
