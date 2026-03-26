@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
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
                    <button type="button" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-xl flex justify-center items-center transition-all duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 group">
                        <svg class="w-6 h-6 mr-3 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Add to Cart 
                        <span class="ml-2 bg-indigo-500/50 px-2 py-0.5 rounded text-sm group-hover:bg-indigo-500 transition-colors">
                            ${{ number_format($product->discount_price ?? $product->price, 2) }}
                        </span>
                    </button>
                    <p class="text-center text-sm text-gray-500 mt-4 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-1.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        In stock and ready to ship
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
    </div>
</div>
@endsection
