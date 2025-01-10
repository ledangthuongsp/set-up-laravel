<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Link to AdminLTE CSS here -->
</head>
<body>
    <div class="wrapper">
        @include('partials.navbar')
        @include('partials.sidebar')

        <div class="content-wrapper">
            @yield('content_header')
            <section class="content">
                @yield('content')
            </section>
        </div>

        @include('partials.footer')
    </div>

    <!-- Include necessary scripts -->
</body>
</html>
