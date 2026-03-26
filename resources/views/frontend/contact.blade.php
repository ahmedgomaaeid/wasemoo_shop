@extends('layouts.app')

@section('title', 'Contact Us - Wasemoo Shop')

@section('content')
<div class="bg-gray-50 py-16 min-h-[80vh] flex flex-col justify-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="bg-white rounded-3xl shadow-xl shadow-indigo-100/50 border border-gray-100 overflow-hidden lg:flex">
            
            <div class="bg-indigo-600 lg:w-2/5 p-10 text-white flex flex-col justify-center relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-indigo-700 opacity-90"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl font-extrabold mb-6">Get in Touch</h2>
                    <p class="text-indigo-100 mb-10 leading-relaxed">
                        Have a question about our cyber security certifications or need help with a purchase? We're here to help you succeed!
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-indigo-300 mr-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                            <span class="text-indigo-50 font-medium">support@wasemooshop.com</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-indigo-300 mr-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" /></svg>
                            <span class="text-indigo-50 font-medium">Cyber Security Division</span>
                        </div>
                    </div>
                </div>
                
                <!-- Decorative Circles -->
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-indigo-500 rounded-full opacity-50 blur-3xl"></div>
                <div class="absolute -top-24 -left-24 w-48 h-48 bg-indigo-400 rounded-full opacity-50 blur-2xl"></div>
            </div>

            <div class="lg:w-3/5 p-8 lg:p-12">
                <form action="{{ route('frontend.contact.store') }}" method="POST">
                    @csrf
                    
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl text-sm font-medium flex items-center shadow-sm">
                            <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl text-sm font-medium flex items-center shadow-sm">
                            <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-base font-semibold text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name" id="name" required value="{{ old('name') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-4 border transition-colors bg-gray-50 hover:bg-white" placeholder="John Doe">
                            @error('name') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-base font-semibold text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" id="email" required value="{{ old('email') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-4 border transition-colors bg-gray-50 hover:bg-white" placeholder="you@example.com">
                            @error('email') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="subject" class="block text-base font-semibold text-gray-700 mb-2">Subject</label>
                        <input type="text" name="subject" id="subject" required value="{{ old('subject') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-4 border transition-colors bg-gray-50 hover:bg-white" placeholder="How can we help?">
                        @error('subject') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="message" class="block text-base font-semibold text-gray-700 mb-2">Message</label>
                        <textarea name="message" id="message" rows="5" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-4 border transition-colors bg-gray-50 hover:bg-white resize-none" placeholder="Write your message here...">{{ old('message') }}</textarea>
                        @error('message') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Google reCAPTCHA -->
                    <div class="mb-8">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY', 'YOUR_SITE_KEY') }}"></div>
                        @error('g-recaptcha-response') <span class="text-red-500 text-xs mt-2 font-medium block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-200 text-base font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all hover:-translate-y-0.5">
                        Send Message
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection
