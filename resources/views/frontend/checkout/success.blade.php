@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden text-center border-t-8 border-green-500">
        <div class="p-10 pt-12">
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-50 border-4 border-green-100 mb-6">
                <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2 tracking-tight">Payment Successful!</h2>
            <p class="text-gray-500 mb-8 text-lg">Thank you, <span class="font-semibold text-gray-800">{{ $order->first_name }}</span>. Your order has been securely processed.</p>
            
            <div class="bg-gray-50 rounded-2xl p-5 mb-8 text-left border border-gray-100">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-sm text-gray-500 font-medium">Reference Code</span>
                    <span class="font-mono text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded">{{ $order->reference_number }}</span>
                </div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-sm text-gray-500 font-medium">Order Amount</span>
                    <span class="font-bold text-gray-900 text-lg">${{ number_format($order->amount, 2) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500 font-medium">Item Purchased</span>
                    <span class="font-semibold text-indigo-600 truncate max-w-[150px]">{{ $order->product->name }}</span>
                </div>
            </div>
            <a href="{{ route('home') }}" class="w-full h-14 inline-flex justify-center items-center px-6 border border-transparent shadow-md shadow-indigo-200 text-base font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:-translate-y-0.5">
                Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection
