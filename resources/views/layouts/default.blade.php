<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @include('components.layouts.default.seo')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.min.css" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/css/lightgallery.min.css"
        integrity="sha512-Szyqrwc8kFyWMllOpTgYCMaNNm/Kl8Fz0jJoksPZAWUqhE60VRHiLLJVcIQKi+bOMffjvrPCxtwfL+/3NPh/ag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
        integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/app-992.css') }}" media="(min-width: 992px)">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/countup@1.8.2/dist/countUp.min.js"></script>

    <script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"
        integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"
        integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/lightgallery.min.js"
        integrity="sha512-+cRLP8t0rsqPalRf//6kfVwRVPzxvwtgLOm8XoSw+M/ND6/0aODP3WFs8m4EPtqsJ9aurqbYq4q/0u8lRJSldA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

    <script src="{{ mix('/js/app.js') }}"></script>
    @php
        setlocale(LC_MONETARY, 'vi-VN');
    @endphp
</head>

<body id="{{ $page_id ?? '' }}">
    @include('components.layouts.default.header')
    @include('components.common.logout-form')

    @yield('main-content')

    @include('components.common.login-register-form')
    @include('components.common.advanced-search')
    @include('components.common.back-to-top')
</body>

</html>
