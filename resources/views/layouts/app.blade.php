<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Wasemoo Shop')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="icon" type="image/png" href="{{ asset('imgs/logo.png') }}">
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased selection:bg-indigo-500 selection:text-white flex flex-col min-h-screen">
    <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 transition-transform duration-200 hover:scale-105">
                        <img src="{{ asset('imgs/logo.png') }}" alt="Wasemoo Logo" class="h-10 w-auto">
                        <span class="font-bold text-xl tracking-tight text-gray-800">Wasemoo Shop</span>
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6 gap-6">
                    <!-- Nav links removed -->
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Wasemoo Shop. All rights reserved. <br>
            Designed with <span class="text-red-500">&hearts;</span> for a stylish experience.
        </div>
    </footer>
</body>
</html>
