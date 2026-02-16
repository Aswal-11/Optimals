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
        document.addEventListener("DOMContentLoaded", function() {
            const flash = document.getElementById('flash-message');

            if (flash) {
                setTimeout(function() {
                    flash.classList.add('opacity-0');
                    setTimeout(() => flash.remove(), 500);
                }, 3000);
            }
        });
    </script>
    
</body>

</html>
