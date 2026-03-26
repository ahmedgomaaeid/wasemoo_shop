@extends('layouts.admin')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Support Messages</h1>
        <p class="text-sm text-gray-500 mt-1">Review and manage messages submitted via the Contact Us form.</p>
    </div>
    
    <div class="bg-white px-2 py-1 rounded-xl shadow-sm border border-gray-100 flex items-center">
        <form action="{{ route('admin.contacts.index') }}" method="GET" class="flex w-full items-center">
            <svg class="w-4 h-4 text-gray-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
            <select name="status" onchange="this.form.submit()" class="bg-transparent border-none text-sm font-semibold text-gray-700 focus:ring-0 cursor-pointer py-2 pl-3 pr-8 w-40">
                <option value="">All Messages</option>
                <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
            </select>
        </form>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Sender</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Subject</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($messages as $msg)
                <tr class="hover:bg-gray-50 transition-colors {{ !$msg->is_read ? 'bg-indigo-50/30' : '' }}">
                    <td class="px-6 py-5 whitespace-nowrap">
                        @if($msg->is_read)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                Read
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-indigo-100 text-indigo-700 shadow-sm border border-indigo-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-1.5"></span>
                                New
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        <div class="text-sm {{ !$msg->is_read ? 'font-bold text-gray-900' : 'font-semibold text-gray-700' }}">{{ $msg->name }}</div>
                        <div class="text-sm text-gray-500">{{ $msg->email }}</div>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        <div class="text-sm {{ !$msg->is_read ? 'font-bold text-gray-900' : 'text-gray-800' }} max-w-[250px] truncate">{{ $msg->subject }}</div>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500 font-medium">
                        {{ $msg->created_at->format('M d, Y') }}<br>
                        <span class="text-xs text-gray-400">{{ $msg->created_at->diffForHumans() }}</span>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('admin.contacts.show', $msg) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors flex items-center font-semibold">
                                View
                            </a>
                            <form action="{{ route('admin.contacts.destroy', $msg) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-1.5 rounded-lg transition-colors">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center text-gray-500">
                        <svg class="mx-auto h-14 w-14 text-indigo-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <p class="text-lg font-medium text-gray-600">No messages found.</p>
                        <p class="text-sm mt-1 text-gray-400">Inbox zero! Good job.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
        {{ $messages->appends(request()->query())->links('pagination::tailwind') }}
    </div>
    @endif
</div>
@endsection
