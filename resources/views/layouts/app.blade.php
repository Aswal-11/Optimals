<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'Default Title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    {{-- Include Header --}}
    @include('partials.header')

    {{-- Page Content --}}
    <div>
        @yield('content')
    </div>

    {{-- Include Footer --}}
    @include('partials.footer')

    <script>
        function dismissFlash() {
            const el = document.getElementById('flash-message');
            el.style.opacity = '0';
            el.style.transform = 'translateX(20px)';
            el.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            setTimeout(() => el.remove(), 300);
        }
        // Auto-dismiss after 4 seconds
        setTimeout(dismissFlash, 4000);
    </script>

</body>

</html>
