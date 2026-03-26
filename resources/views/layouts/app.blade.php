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

    <footer class="bg-white border-t border-gray-100 mt-auto">
        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 md:order-2">
                    <img src="{{ asset('imgs/Visa-Mastercard-logos-footer.png') }}" alt="Visa and Mastercard Secure Payment" class="h-10 w-auto object-contain">
                    <img src="{{ asset('imgs/lahza.png') }}" alt="Lahza Payment Gateway" class="h-10 w-auto object-contain">
                </div>
                <p class="text-center md:text-left text-gray-500 text-sm font-medium">
                        &copy; {{ date('Y') }} Wasemoo Shop. All rights reserved.
                    </p>
                <div class="md:mt-0 md:order-1 flex flex-col items-center md:items-start">
                    
                    <div class="text-sm text-gray-500 flex flex-wrap items-center justify-center md:justify-start gap-x-6 gap-y-2">
                        <a href="{{ route('terms') }}" class="hover:text-indigo-600 font-medium transition-colors border-b border-transparent hover:border-indigo-600 pb-0.5">Privacy, Terms & Refund Policy</a>
                        <a href="{{ route('frontend.contact') }}" class="hover:text-indigo-600 font-medium transition-colors border-b border-transparent hover:border-indigo-600 pb-0.5">Contact Us</a>
                    </div>
                </div>
                
            </div>
        </div>
    </footer>
</body>
</html>
