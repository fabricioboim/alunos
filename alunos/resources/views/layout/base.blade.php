<!DOCTYPE html>

<title>@yield('title')</title>
@include('layout.header')
@yield('page_css')


<body>
    @include('layout.nav')

    <main class="container-fluid">
        @yield('body')
    </main>

    @include('layout.footer')
    @yield('page_js')
</body>

</html>
