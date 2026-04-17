<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('argon/assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('argon/assets/css/argon-dashboard.css') }}" rel="stylesheet">

    <style>
        .main-content {
            background: linear-gradient(87deg, #172b4d 0, #1a174d 100%) !important;
            min-height: 100vh;
            display: flex;
            align-items: center; /* Membuat card bener-bener di tengah */
            position: relative;
            overflow: hidden;
        }

        /* Animasi Background */
        .bg-circles { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; }
        .circle { position: absolute; background: rgba(255, 255, 255, 0.05); border-radius: 50%; animation: move 25s infinite linear; }
        @keyframes move {
            from { transform: translateY(0) rotate(0deg); opacity: 1; }
            to { transform: translateY(-1000px) rotate(720deg); opacity: 0; }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border-radius: 1rem !important;
            border: none;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="bg-circles">
            <div class="circle" style="width: 80px; height: 80px; left: 10%; bottom: -100px;"></div>
            <div class="circle" style="width: 150px; height: 150px; left: 70%; bottom: -200px; animation-delay: 8s;"></div>
        </div>

        <div class="container">
            {{ $slot }}
        </div>
    </div>
</body>
</html>