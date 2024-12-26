<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="robots" content="nofollow">
    <meta name="description" content="Datahan Test">
    <title>@yield('title')</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/scss/style.scss', 'resources/js/app.js'])
    @endif

    @yield('css')
</head>
<body>

@include('site.sections.header')

@yield('body')

@yield('js')

@include('site.sections.footer')
</body>
</html>

