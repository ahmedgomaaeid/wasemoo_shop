<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Wasemoo Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('imgs/logo.png') }}">
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 h-screen overflow-hidden relative">
    
    <!-- Sidebar (Always rendered underneath on mobile, static on desktop) -->
    <aside class="fixed inset-y-0 left-0 w-64 bg-white z-0 border-r border-gray-200 flex flex-col">
        <div class="h-16 flex items-center justify-center px-6 border-b border-gray-100 flex-shrink-0 py-2">
            <img src="{{ asset('imgs/logo.png') }}" alt="Wasemoo Admin" class="h-10 w-auto">
        </div>
        <div class="p-4 flex-grow overflow-y-auto">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.sections.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors {{ request()->routeIs('admin.sections.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Sections
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Products
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Orders
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contacts.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors {{ request()->routeIs('admin.contacts.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        Messages
                        @php
                            $unreadMsg = \App\Models\Contact::where('is_read', false)->count();
                        @endphp
                        @if($unreadMsg > 0)
                            <span class="ml-auto bg-indigo-100 text-indigo-600 py-0.5 px-2 rounded-full text-xs font-bold">{{ $unreadMsg }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- User Menu (Bottom Sidebar) -->
        <div class="p-4 border-t border-gray-100 flex-shrink-0">
            <div class="flex items-center mb-4 px-2">
                <div class="w-8 h-8 rounded-full bg-indigo-100 flex flex-shrink-0 items-center justify-center text-indigo-600 font-bold">
                    {{ substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="ml-3 overflow-hidden">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::guard('admin')->user()->email ?? '' }}</p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper (Sits on top and pushes right) -->
    <div id="main-wrapper" class="relative z-10 h-screen w-full bg-gray-50 flex flex-col transition-transform duration-300 ease-in-out lg:ml-64 lg:w-[calc(100%-16rem)] shadow-2xl lg:shadow-none border-l border-gray-200 lg:border-none">
        
        <!-- Mobile Header -->
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-4 sm:px-6 z-20 flex-shrink-0 lg:hidden relative">
            <div class="flex items-center">
                <button id="toggle-sidebar" class="p-2 -ml-2 mr-3 text-gray-500 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <img src="{{ asset('imgs/logo.png') }}" alt="Wasemoo" class="h-8 w-auto">
            </div>
            <div class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold border border-indigo-200">
                    {{ substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 sm:p-6 md:p-8 relative">
            <!-- Transparent overlay to intercept clicks and close menu on mobile -->
            <div id="main-overlay" class="absolute inset-0 z-50 hidden cursor-pointer bg-transparent"></div>
            
            <div class="max-w-6xl mx-auto">
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-sm" role="alert">
                        <span class="block sm:inline font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg shadow-sm" role="alert">
                        <span class="block sm:inline font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mainWrapper = document.getElementById('main-wrapper');
            const toggleBtn = document.getElementById('toggle-sidebar');
            const mainOverlay = document.getElementById('main-overlay');

            let isSidebarOpen = false;

            function toggleSidebar() {
                if (isSidebarOpen) {
                    mainWrapper.classList.remove('translate-x-64');
                    mainOverlay.classList.add('hidden');
                    isSidebarOpen = false;
                } else {
                    mainWrapper.classList.add('translate-x-64');
                    mainOverlay.classList.remove('hidden');
                    isSidebarOpen = true;
                }
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            if (mainOverlay) {
                mainOverlay.addEventListener('click', (e) => {
                    e.stopPropagation();
                    if (isSidebarOpen) toggleSidebar();
                });
            }

            // Close sidebar when resizing to desktop explicitly
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024 && isSidebarOpen) {
                    toggleSidebar();
                }
            });
        });
    </script>
</body>
</html>
