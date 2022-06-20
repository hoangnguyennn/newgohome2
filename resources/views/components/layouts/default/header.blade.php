<header class="header">
    <div class="wrap">
        <div class="logo">
            <a href="{{ route('home') }}" title="Go to GoHome's homepage">
                <span class="d-none">Go to GoHome's homepage</span>
                <img src="{{ mix('images/webp/logo.webp') }}" alt="" />
            </a>
        </div>

        <a href="#" class="header-search" title="Header's search">
            <i class="las la-search"></i>
            <i class="las la-times"></i>
            <span>Tìm kiếm...</span>
        </a>

        @include('components.layouts.default.header-search')

        <div class="right">
            @if (Auth::check())
                <a class="login-toggler dropdown-toggle" href="#" id="user-dropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="lar la-user mr-1 size-16"></i>
                    <span>{{ Auth::user()->fullname }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-dropdown">
                    <a class="dropdown-item" href="{{ route('posts.index') }}">Quản lý</a>
                    <a class="dropdown-item btn-logout" href="{{ route('logout') }}">Đăng xuất</a>
                </div>
            @else
                <a href="#" class="login-toggler" data-toggle="modal" data-target="#login-register-form"
                    title="Open the login form">
                    <i class="lar la-user"></i>
                    <span>Đăng nhập</span>
                </a>
            @endif

            <a href="#" class="notification">
                <i class="las la-bell"></i>
                <span class="noti-counter">0</span>
            </a>

            <a href="#" class="language">
                <i class="las la-globe"></i>
                <i class="las la-angle-down"></i>
            </a>

            <div class="language-dropdown">
                <div class="language-wrap">
                    <div class="item">
                        <h4>Ngôn ngữ: <span>VN</span>
                            <i class="las la-angle-down"></i>
                        </h4>
                    </div>
                    <div class="item">
                        <h4>Tiền tệ: <span>VND</span></span>
                            <i class="las la-angle-down"></i>
                        </h4>
                    </div>
                </div>
            </div>

            <div class="menu-toggle">
                <div class="icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="main-menu">
                <div class="language-wrap">
                    <div class="item">
                        <h4>Ngôn ngữ: <span>VN</span>
                            <i class="las la-angle-down"></i>
                        </h4>
                    </div>
                    <div class="item">
                        <h4>Tiền tệ: <span>VND</span></span>
                            <i class="las la-angle-down"></i>
                        </h4>
                    </div>
                </div>

                @if (Auth::check())
                    <a href="{{ route('posts.index') }}" class="add-listing">Add listing</a>
                @else
                    <a href="#" class="add-listing" data-toggle="modal" data-target="#login-register-form">Add
                        listing</a>
                @endif
            </div>

            <div class="main-menu-pc">
                @if (Auth::check())
                    <a href="{{ route('posts.index') }}" class="add-listing">
                        <i class="las la-plus"></i>
                        <span>Add listing</span>
                    </a>
                @else
                    <a href="#" class="add-listing" data-toggle="modal" data-target="#login-register-form">
                        <i class="las la-plus"></i>
                        <span>Add listing</span>
                    </a>
                @endif

            </div>
        </div>
    </div>
</header>

<script>
    $('.menu-toggle').on('click', function() {
        $('.main-menu').toggleClass('show');
    });

    $('.header-search').on('click', function(event) {
        event.preventDefault();
        $('.header-search').toggleClass('show');
    });

    $('.language').on('click', function(event) {
        event.preventDefault();
        $('.language-dropdown').toggleClass('show');
    })
</script>
