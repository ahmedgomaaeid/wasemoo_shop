@extends('layouts.app')

@section('content')
<div x-data="{ showCheckoutModal: {{ session('error') || $errors->any() ? 'true' : 'false' }} }" class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-500 font-medium mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><a href="{{ route('frontend.section', $product->section->slug) }}" class="hover:text-indigo-600 transition-colors">{{ $product->section->name }}</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-900 truncate max-w-[200px] inline-block">{{ $product->name }}</span></li>
            </ol>
        </nav>

        <!-- Product Details -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden lg:flex">
            <!-- Image Gallery -->
            <div class="lg:w-1/2 bg-gray-50 p-6 flex flex-col justify-center items-center h-[500px] lg:h-auto border-b lg:border-b-0 lg:border-r border-gray-100 relative">
                @if($product->image_path)
                    <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-contain mix-blend-multiply drop-shadow-xl hover:scale-105 transition-transform duration-500">
                @else
                    <svg class="w-32 h-32 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                @endif
                
                @if($product->discount_price)
                <div class="absolute top-6 left-6 bg-red-500 text-white px-4 py-1.5 rounded-full text-sm font-bold shadow-lg">
                    @php 
                        $discountPercentage = round((($product->price - $product->discount_price) / $product->price) * 100); 
                    @endphp
                    Save {{ $discountPercentage }}%
                </div>
                @endif
            </div>
            
            <!-- Product Info -->
            <div class="lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center">
                <a href="{{ route('frontend.section', $product->section->slug) }}" class="text-sm text-indigo-600 font-semibold tracking-wide uppercase mb-2 hover:underline">{{ $product->section->name }}</a>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight mb-4">
                    {{ $product->name }}
                </h1>
                
                <div class="flex items-end mb-6">
                    @if($product->discount_price)
                        <span class="text-4xl font-extrabold text-red-600">${{ number_format($product->discount_price, 2) }}</span>
                        <span class="ml-3 text-xl font-medium text-gray-400 line-through mb-1">${{ number_format($product->price, 2) }}</span>
                    @else
                        <span class="text-4xl font-extrabold text-gray-900">${{ number_format($product->price, 2) }}</span>
                    @endif
                </div>
                
                <div class="border-t border-b border-gray-100 py-6 mb-8">
                    <p class="text-base text-gray-600 leading-relaxed whitespace-pre-line">
                        {{ $product->description ?? 'No description available for this product.' }}
                    </p>
                </div>
                
                <div class="mt-auto">
                    <button @click="showCheckoutModal = true" type="button" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-xl flex justify-center items-center transition-all duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 group">
                        <svg class="w-6 h-6 mr-3 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Buy Now 
                        <span class="ml-2 bg-indigo-500/50 px-2 py-0.5 rounded text-sm group-hover:bg-indigo-500 transition-colors">
                            ${{ number_format($product->discount_price ?? $product->price, 2) }}
                        </span>
                    </button>
                    <p class="text-center text-sm text-gray-500 mt-4 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-1.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Secure payment powered by Lahza
                    </p>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-24 mb-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">You might also like</h2>
                <a href="{{ route('frontend.section', $product->section->slug) }}" class="text-indigo-600 font-medium hover:text-indigo-800 transition-colors">View all {{ $product->section->name }} &rarr;</a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-10 gap-x-6 xl:gap-x-8">
                @foreach($relatedProducts as $related)
                <div class="group relative flex flex-col bg-white rounded-2xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-full h-48 bg-gray-50 rounded-xl overflow-hidden mb-4 relative">
                        @if($related->image_path)
                            <img src="{{ asset('storage/'.$related->image_path) }}" alt="{{ $related->name }}" class="w-full h-full object-center object-cover group-hover:scale-105 transition-transform duration-500 mix-blend-multiply">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-50">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col flex-1 justify-between">
                        <h3 class="text-sm text-gray-800 font-semibold group-hover:text-indigo-600 transition-colors line-clamp-2 mb-2">
                            <a href="{{ route('frontend.product', $related->slug) }}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $related->name }}
                            </a>
                        </h3>
                        <div class="mt-auto flex items-center justify-between">
                            <div class="flex items-center">
                                @if($related->discount_price)
                                    <p class="text-sm font-bold text-red-600">${{ number_format($related->discount_price, 2) }}</p>
                                    <p class="ml-1.5 text-xs font-medium text-gray-400 line-through">${{ number_format($related->price, 2) }}</p>
                                @else
                                    <p class="text-sm font-bold text-gray-900">${{ number_format($related->price, 2) }}</p>
                                @endif
                            </div>
                            <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <!-- Checkout Modal -->
        <div x-show="showCheckoutModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
            
            <div x-show="showCheckoutModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/75 transition-opacity backdrop-blur-sm"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    
                    <div x-show="showCheckoutModal" @click.away="showCheckoutModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-100">
                        
                        <div class="bg-gray-50 px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-gray-200">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 sm:mx-0 sm:h-12 sm:w-12 shadow-inner">
                                    <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /></svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left flex-1">
                                    <h3 class="text-xl font-bold leading-6 text-gray-900" id="modal-title">Secure Checkout</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">You are about to purchase <span class="font-semibold text-gray-900">{{ $product->name }}</span> for <span class="font-bold text-indigo-600">${{ number_format($product->discount_price ?? $product->price, 2) }}</span>.</p>
                                    </div>
                                </div>
                                <button type="button" @click="showCheckoutModal = false" class="text-gray-400 hover:text-gray-500 focus:outline-none bg-gray-100 hover:bg-gray-200 rounded-full p-1 transition-colors">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('checkout.process', $product) }}" class="px-6 py-6 border-b border-gray-100">
                            @csrf
                            
                            @if(session('error'))
                                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-medium shadow-sm">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                                <div>
                                    <label for="first_name" class="block text-base font-semibold text-gray-700 mb-2">First Name</label>
                                    <input type="text" name="first_name" id="first_name" required value="{{ old('first_name') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-4 border transition-colors bg-gray-50 hover:bg-white placeholder-gray-400" placeholder="John">
                                    @error('first_name') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="last_name" class="block text-base font-semibold text-gray-700 mb-2">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" required value="{{ old('last_name') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-4 border transition-colors bg-gray-50 hover:bg-white placeholder-gray-400" placeholder="Doe">
                                    @error('last_name') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <label for="email" class="block text-base font-semibold text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="email" id="email" required value="{{ old('email') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-4 border transition-colors bg-gray-50 hover:bg-white placeholder-gray-400" placeholder="john@example.com">
                                @error('email') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-8">
                                <label for="phone" class="block text-base font-semibold text-gray-700 mb-2">Phone Number</label>
                                <input type="text" name="phone" id="phone" required value="{{ old('phone') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-4 border transition-colors bg-gray-50 hover:bg-white placeholder-gray-400" placeholder="+1 (555) 000-0000">
                                @error('phone') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Google reCAPTCHA -->
                            <div class="mb-2 flex flex-col justify-center items-center">
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY', 'YOUR_SITE_KEY') }}"></div>
                                @error('g-recaptcha-response') <span class="text-red-500 text-xs mt-2 font-medium block w-full text-center">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-8 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-4">
                                <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-indigo-600 px-3 py-4 text-base font-bold text-white shadow-xl shadow-indigo-200 hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2 transition-all hover:-translate-y-0.5">
                                    Pay Now
                                </button>
                                <button type="button" @click="showCheckoutModal = false" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-4 text-base font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0 transition-colors">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
