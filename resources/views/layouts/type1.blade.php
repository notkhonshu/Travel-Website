@include('partials.header')

<body {!! isset($navbarSettings["sticky_first"]) ? "data-sticky-first='true'" : "" !!}>
    @include('partials.navbar', [
        "layout_settings" => $layout_settings
    ])

    @yield('content')
    
    @include('partials.footer')
</body>

</html>