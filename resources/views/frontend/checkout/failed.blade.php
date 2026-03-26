@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden text-center border-t-8 border-red-500">
        <div class="p-10 pt-12">
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-red-50 border-4 border-red-100 mb-6">
                <svg class="h-12 w-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2 tracking-tight">Payment Failed</h2>
            <p class="text-gray-500 mb-8 text-lg">We're sorry <span class="font-semibold text-gray-800">{{ $order->first_name }}</span>, but we couldn't process your payment. No charges were made to your account.</p>
            
             <div class="bg-gray-50 rounded-2xl p-5 mb-8 text-left border border-gray-100">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-sm text-gray-500 font-medium">Reference Code</span>
                    <span class="font-mono text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded">{{ $order->reference_number ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="space-y-4">
                <a href="{{ route('frontend.product', $order->product->slug) }}" class="w-full h-14 inline-flex justify-center items-center px-6 border border-transparent shadow-md shadow-indigo-200 text-base font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Try Again
                </a>
                <a href="{{ route('home') }}" class="w-full h-14 inline-flex justify-center items-center px-6 border border-gray-200 shadow-sm text-base font-bold rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Return to Homepage
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
