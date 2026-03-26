<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Wasemoo Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans antialiased text-gray-900 h-screen flex overflow-hidden">
    
    <!-- Left Side: Login Form -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 md:px-24 lg:px-32 xl:px-40 relative z-10 bg-white h-full overflow-y-auto shadow-2xl">
        <div class="w-full max-w-md mx-auto py-12">
            <!-- Logo / Brand -->
            <div class="mb-10 flex items-center gap-3">
                <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <span class="text-2xl font-bold tracking-tight text-gray-900">Wasemoo Shop</span>
            </div>

            <!-- Header -->
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2 tracking-tight">Welcome back</h1>
            <p class="text-gray-500 mb-10 text-lg">Please enter your details to access the admin panel.</p>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf
                
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                        class="w-full rounded-xl border border-gray-200 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-100 sm:text-base p-4 transition duration-200 placeholder-gray-400 bg-gray-50 hover:bg-white" placeholder="admin@example.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full rounded-xl border border-gray-200 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-100 sm:text-base p-4 transition duration-200 placeholder-gray-400 bg-gray-50 hover:bg-white" placeholder="••••••••">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-2">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                        <label for="remember" class="ml-2 block text-sm font-medium text-gray-700 cursor-pointer">Remember me for 30 days</label>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center items-center py-4 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-300/50 text-base font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:-translate-y-0.5">
                        Sign in to Dashboard
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </button>
                </div>
            </form>

            <p class="mt-12 text-center text-sm text-gray-500 font-medium">
                &copy; {{ date('Y') }} Wasemoo Shop. Admin access only.
            </p>
        </div>
    </div>

    <!-- Right Side: Beautiful Image / Gradient -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-indigo-900 border-l border-indigo-100 overflow-hidden">
        <!-- Abstract beautiful shapes -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-700 via-indigo-900 to-black opacity-90 z-10"></div>
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" class="absolute inset-0 w-full h-full object-cover mix-blend-overlay" alt="Abstract Office">
        
        <div class="absolute inset-0 flex flex-col justify-center items-start p-20 z-20">
            <div class="bg-white/10 backdrop-blur-xl border border-white/20 p-10 rounded-[2rem] shadow-2xl max-w-lg transition-transform hover:scale-[1.02] duration-500">
                <div class="w-14 h-14 bg-indigo-500/30 rounded-full flex items-center justify-center mb-8 border border-white/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h2 class="text-4xl font-extrabold text-white mb-6 leading-tight tracking-tight">Manage your store with precision and style.</h2>
                <p class="text-indigo-100 text-lg font-medium leading-relaxed mb-8">
                    The Wasemoo Admin Panel equips you with the modern tools necessary to handle sections, process products, and track real-time analytics with ease.
                </p>
                <div class="mt-8 flex items-center pt-8 border-t border-white/10">
                    <div class="flex -space-x-3">
                        <img class="w-10 h-10 rounded-full border-2 border-indigo-900 object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=64&h=64" alt="User">
                        <img class="w-10 h-10 rounded-full border-2 border-indigo-900 object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=64&h=64" alt="User">
                        <img class="w-10 h-10 rounded-full border-2 border-indigo-900 object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=64&h=64" alt="User">
                    </div>
                    <p class="text-white text-sm ml-4 font-semibold">Join 10,000+ top managers</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
