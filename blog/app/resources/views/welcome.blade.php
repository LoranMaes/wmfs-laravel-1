<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/icons/apple-touch-icon.png') }}" sizes="180x180">
    <link rel="icon" href="{{ asset('img/icons/favicon-32x32.png" sizes="32x32') }}" type="image/png">
    <link rel="icon" href="{{ asset('img/icons/favicon-16x16.png" sizes="16x16') }}" type="image/png">
    <link rel="mask-icon" href="{{ asset('img/icons/safari-pinned-tab.svg') }}" color="#7952b3">
    <link rel="icon" href="{{ asset('img/icons/favicon.ico') }}">
    <meta name="theme-color" content="#7952b3">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container">
        @include('partials/header')
        @section('pageContent')
        @show
        @include('partials/footer')
    </div>
</body>

</html>