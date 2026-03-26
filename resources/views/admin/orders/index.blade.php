@extends('layouts.admin')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Orders Overview</h1>
        <p class="text-sm text-gray-500 mt-1">Manage and view completed, failed, or returned orders.</p>
    </div>
    
    <div class="bg-white px-2 py-1 rounded-xl shadow-sm border border-gray-100 flex items-center">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="flex w-full items-center">
            <svg class="w-4 h-4 text-gray-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
            <select name="type" onchange="this.form.submit()" class="bg-transparent border-none text-sm font-semibold text-gray-700 focus:ring-0 cursor-pointer py-2 pl-3 pr-8 w-40">
                <option value="">All Statuses</option>
                <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Successful</option>
                <option value="2" {{ request('type') == '2' ? 'selected' : '' }}>Failed</option>
                <option value="3" {{ request('type') == '3' ? 'selected' : '' }}>Returned</option>
            </select>
        </form>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Order ID / Ref</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Customer Info</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Product</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Amount</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status Badge</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-5 whitespace-nowrap">
                        <div class="text-sm font-extrabold text-gray-900">#{{ $order->id }}</div>
                        <div class="text-xs text-gray-500 font-mono mt-0.5">{{ $order->reference_number ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        <div class="text-sm font-bold text-gray-900">{{ $order->first_name }} {{ $order->last_name }}</div>
                        <div class="text-sm text-gray-500">{{ $order->email }}</div>
                        <div class="text-xs text-gray-400 mt-0.5">{{ $order->phone }}</div>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        <div class="text-sm text-indigo-600 font-semibold max-w-[200px] truncate">{{ $order->product->name ?? 'Deleted Product' }}</div>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        <div class="text-base font-extrabold text-gray-900">${{ number_format($order->amount, 2) }}</div>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        @if($order->type == 1)
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-800 shadow-sm border border-green-200">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                SUCCESS
                            </span>
                        @elseif($order->type == 2)
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-red-100 text-red-800 shadow-sm border border-red-200">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                FAILED
                            </span>
                        @elseif($order->type == 3)
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 shadow-sm border border-yellow-200">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path></svg>
                                RETURNED
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500 font-medium">
                        {{ $order->created_at->format('M d, Y') }}<br>
                        <span class="text-xs text-gray-400">{{ $order->created_at->format('H:i A') }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center text-gray-500">
                        <svg class="mx-auto h-14 w-14 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <p class="text-lg font-medium text-gray-600">No orders found.</p>
                        <p class="text-sm mt-1 text-gray-400">Orders with a valid status will appear here.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
        {{ $orders->appends(request()->query())->links('pagination::tailwind') }}
    </div>
    @endif
</div>
@endsection
