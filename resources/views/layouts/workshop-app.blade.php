<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        @component('layouts.nav')
        @endcomponent
        <main>
            @yield('content')
        </main>

        <flash-message class="flasher"></flash-message>
    </div>


    {{-- <script src="/js/app.js"></script>  --}}
    <!-- Scripts -->
    <script src="{{ asset('js/workshopApp.js') }}" defer></script>
    

    <div class="invisible">
        @yield('invisible-content')
    </div>
</body>

</html>
