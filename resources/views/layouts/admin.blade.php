<html lang="vi">

<head>
    <meta charset="utf8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- <link rel="icon" href="{{ mix('images/favicon.ico') }}" /> --}}

    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    <link rel="stylesheet" href="{{ mix('css/app.custom.css') }}" /> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />

    @section('styles')
    @show

    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>

    <script src="{{ mix('js/app.js') }}"></script>

    <title>GoHome</title>
</head>

<body>
    @include('components.layouts.admin.header')
    @include('components.layouts.admin.alert')
    @include('components.layouts.admin.logout-form')

    @yield('main-content')

    @section('scripts')
    @show
</body>

</html>
