<header class="header">
    <div class="container">
        <div class="logo">
            <a href="{{ route('home') }}" title="Go to GoHome's homepage">
                <span class="d-none">Go to GoHome's homepage</span>
                <img src="{{ mix('images/webp/logo.webp') }}" alt="" />
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
    </div>
</header>

<script>
    $('.menu-toggle').on('click', function() {
        $('.main-menu').toggleClass('show');
    });
</script>
