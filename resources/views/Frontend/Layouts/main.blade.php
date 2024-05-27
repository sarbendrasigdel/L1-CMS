<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @include('Frontend.Layouts.styles')

</head>

<body>
    <div class="mil-wrapper" id="top">
        @include('Frontend.Layouts.cursor')
        @include('Frontend.Layouts.scrollprogress')
        @include('Frontend.Layouts.menu')
        @include('Frontend.Layouts.curtain')
        @include('Frontend.Layouts.frame')
        <div class="mil-content">
            <div id="swupMain" class="mil-main-transition">

            @yield('content')

            @include('Frontend.Layouts.footer')
            @include('Frontend.Layouts.hidden')
            
            </div>

        </div>

    </div>

    

@include('Frontend.Layouts.scripts')
</body>

</html>