    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Fonts & Icons --}}
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="{{ asset('argon/assets/css/nucleo-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('argon/assets/css/nucleo-svg.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

        {{-- Argon CSS --}}
        <link href="{{ asset('argon/assets/css/argon-dashboard.css') }}" rel="stylesheet">

        {{-- Laravel Vite (breeze tailwind, kalau masih dipakai) --}}
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    </head>

    <body class="g-sidenav-show bg-gray-100">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Content --}}
        <main class="main-content position-relative border-radius-lg">

            {{-- Navbar --}}
            @include('layouts.navbar')

            {{-- Page Content --}}
            <div class="container-fluid py-4">
                @yield('content')
            </div>
            
        </main>

        {{-- Argon JS --}}
        <script src="{{ asset('argon/assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('argon/assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('argon/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('argon/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <script src="{{ asset('argon/assets/js/argon-dashboard.min.js') }}"></script>
    </body>

    </html>
