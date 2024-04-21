<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layout.admin.include.css')

    @yield('additional-css')

    <title> {{@$title}} </title>

</head>
<body>
    @include('layout.admin.menu.top-menu')
    @include('layout.admin.menu.menu')
    @include('layout.common.loader')

    @yield('main-content')

@include('layout.admin.include.footer')
@include('layout.admin.include.script')


@yield('additional-js')


</body>
</html>
