@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-20">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Premium products for</span>
                        <span class="block text-indigo-600 xl:inline">your lifestyle</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Discover our curated collection of high-quality items designed to elevate your everyday experience. Shop the latest trends with confidence.
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <a href="#sections" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 transition-colors">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://www.wasemoo.com/imgs/lan2.png" alt="Store interior">
    </div>
</div>

<!-- Sections Preview -->
<div id="sections" class="bg-gray-50 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Shop by Category</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($sections as $section)
            <a href="{{ route('frontend.section', $section->slug) }}" class="group block">
                <div class="relative w-full h-80 bg-white rounded-2xl overflow-hidden group-hover:opacity-90 transition-opacity shadow-sm border border-gray-100">
                    @if($section->image_path)
                        <img src="{{ asset('storage/'.$section->image_path) }}" alt="{{ $section->name }}" class="w-full h-full object-center object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-indigo-50 text-indigo-300 group-hover:scale-105 transition-transform duration-500">
                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <h3 class="text-xl font-bold text-white">{{ $section->name }}</h3>
                        <p class="mt-1 text-sm text-gray-200">{{ $section->products_count }} Products</p>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                No categories available yet.
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Latest Products -->
<div class="bg-white py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between mb-8">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Latest Arrivals</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-10 gap-x-6 xl:gap-x-8">
            @forelse($latestProducts as $product)
            <div class="group relative flex flex-col">
                <div class="w-full min-h-80 bg-gray-50 aspect-w-1 aspect-h-1 rounded-2xl overflow-hidden group-hover:shadow-md lg:h-72 lg:aspect-none transition-all duration-300 border border-gray-100 flex-shrink-0">
                    @if($product->image_path)
                        <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover lg:w-full lg:h-full group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300 group-hover:scale-105 transition-transform duration-500">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    @if($product->discount_price)
                        <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-md shadow-sm">
                            Sale
                        </div>
                    @endif
                </div>
                <div class="mt-4 flex flex-col flex-1 justify-between">
                    <div>
                        <p class="text-xs text-indigo-600 font-medium mb-1">{{ $product->section->name ?? '' }}</p>
                        <h3 class="text-sm text-gray-800 font-semibold group-hover:text-indigo-600 transition-colors line-clamp-2">
                            <a href="{{ route('frontend.product', $product->slug) }}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $product->name }}
                            </a>
                        </h3>
                    </div>
                    <div class="mt-2 flex items-center">
                        @if($product->discount_price)
                            <p class="text-base font-bold text-red-600">${{ number_format($product->discount_price, 2) }}</p>
                            <p class="ml-2 text-xs font-medium text-gray-400 line-through">${{ number_format($product->price, 2) }}</p>
                        @else
                            <p class="text-base font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-gray-500 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                <p>No products available right now.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
