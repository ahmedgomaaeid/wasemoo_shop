@extends('layouts.app')

@section('content')
<!-- Header Banner -->
<div class="relative bg-gray-900 py-16 sm:py-24">
    <div class="absolute inset-0 overflow-hidden">
        @if($section->image_path)
            <img src="{{ asset('storage/'.$section->image_path) }}" alt="{{ $section->name }}" class="w-full h-full object-center object-cover opacity-30">
        @else
            <div class="w-full h-full bg-gradient-to-r from-indigo-800 to-purple-900 opacity-80"></div>
        @endif
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-4xl tracking-tight font-extrabold sm:text-5xl lg:text-6xl">{{ $section->name }}</h1>
        @if($section->description)
        <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-200">
            {{ $section->description }}
        </p>
        @endif
    </div>
</div>

<div class="bg-gray-50 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-500 font-medium mb-10" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">Home</a>
                </li>
                <li><span class="text-gray-400">/</span></li>
                <li>
                    <span class="text-gray-900">{{ $section->name }}</span>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-10 gap-x-6 xl:gap-x-8">
            @forelse($products as $product)
            <div class="group relative flex flex-col">
                <div class="w-full min-h-80 bg-white aspect-w-1 aspect-h-1 rounded-2xl overflow-hidden group-hover:shadow-lg lg:h-72 lg:aspect-none transition-all duration-300 border border-gray-100 flex-shrink-0">
                    @if($product->image_path)
                        <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover lg:w-full lg:h-full group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300 group-hover:scale-105 transition-transform duration-500 bg-gray-50">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    @if($product->discount_price)
                        <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-md shadow-sm">
                            Sale
                        </div>
                    @endif
                </div>
                <div class="mt-5 flex flex-col flex-1 justify-between px-1">
                    <div>
                        <h3 class="text-sm text-gray-800 font-semibold group-hover:text-indigo-600 transition-colors line-clamp-2">
                            <a href="{{ route('frontend.product', $product->slug) }}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $product->name }}
                            </a>
                        </h3>
                    </div>
                    <div class="mt-3 flex items-center">
                        @if($product->discount_price)
                            <p class="text-base font-bold text-red-600">${{ number_format($product->discount_price, 2) }}</p>
                            <p class="ml-2 text-sm font-medium text-gray-400 line-through">${{ number_format($product->price, 2) }}</p>
                        @else
                            <p class="text-base font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 bg-white rounded-3xl shadow-sm border border-gray-100 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No products found</h3>
                <p class="mt-1 text-gray-500">We don't have any products in this section right now. Check back later!</p>
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Return Home
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        @if($products->hasPages())
        <div class="mt-12 bg-white px-6 py-4 rounded-xl shadow-sm border border-gray-100">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
