<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
    <title>@yield('page-title')</title>
</head>
<body>
    <div id="app">
        @include('layouts.header')
        <main>
            @yield('content')
        </main>
        @include("layouts.footer")
    </div>
</body>
</html>
