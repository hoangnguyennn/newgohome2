<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('posts.index') }}">GoHome</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
            aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main-menu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ str_contains(Request::fullUrl(), route('posts.index')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('posts.index') }}">Quản lý bài đăng</a>
                </li>
                <li
                    class="nav-item {{ str_contains(Request::fullUrl(), route('posts.rented-list')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('posts.rented-list') }}">Quản lý bài đăng đã thuê</a>
                </li>
                @if (Auth::user()->isAdmin())
                    <li
                        class="nav-item {{ str_contains(Request::fullUrl(), route('post-requests.index')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('post-requests.index') }}">Quản lý yêu cầu</a>
                    </li>
                    <li class="nav-item {{ str_contains(Request::fullUrl(), route('users.index')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users.index') }}">Quản lý người dùng</a>
                    </li>
                @endif
                <li class="nav-item {{ str_contains(Request::fullUrl(), route('statistical')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('statistical') }}">Thống kê</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Xem website</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" type="button" id="notification-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Thông báo
                        <span class="badge badge-danger" id="notification-count">
                            @php
                                $notiCount = Auth::user()
                                    ->unreadNotifications()
                                    ->count();
                            @endphp
                            {{ $notiCount }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right notification-dropdown"
                        aria-labelledby="notification-dropdown">
                        @php
                            $notiCount = Auth::user()
                                ->unreadNotifications()
                                ->count();
                        @endphp
                        @if ($notiCount !== 0)
                            {{ Form::open([
                                'route' => 'notifications.mark-as-read',
                                'method' => 'post',
                                'class' => 'dropdown-item',
                            ]) }}
                            <button type="submit" class="link">Đánh dấu đã đọc</button>
                            {{ Form::close() }}
                        @endif

                        @php
                            $notifications = Auth::user()
                                ->unreadNotifications()
                                ->take(5)
                                ->get();
                        @endphp
                        @foreach ($notifications as $notification)
                            @php
                                $fullname = $notification->data['fullname'];
                                $action = $notification->data['action'];
                                $title = $notification->data['title'];
                                $link = $notification->data['link'];
                                $created_at = date_create($notification->data['created_at']);
                            @endphp
                            <a class="dropdown-item" href="{{ $link . '?noti=' . $notification->id }}">
                                {{ $fullname }} đã {{ $action }} {{ $title }} vào lúc
                                {{ $created_at->format('h:i:s d/m/Y') }}
                            </a>
                        @endforeach
                        @if (count($notifications) == 0)
                            <span class="dropdown-item">Không có thông báo nào</span>
                        @endif
                    </div>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="user-dropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->fullname }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-dropdown">
                        <a class="dropdown-item" href="#">Cập nhật hồ sơ</a>
                        <a class="dropdown-item btn-logout" href="{{ route('logout') }}">Đăng xuất</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    const notiButton = document.querySelector('#notification-dropdown');
    const notiCount = document.querySelector('#notification-count')
    notiButton.addEventListener('click', markAllAsRead);

    function markAllAsRead() {
        const userId = "{{ Auth::user()->id }}";
        const api = "{{ route('api.notifications.mark-all-as-read') }}";
        axios.post(api, {
            userId
        }, {
            withCredentials: true
        }).then((res) => {
            console.log('xong', res.data);
            notiCount.innerHTML = 0;
        });
    }
</script>
