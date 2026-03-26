@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Inbox
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden max-w-4xl">
    <div class="p-6 sm:p-8 border-b border-gray-100 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-1">{{ $contact->subject }}</h1>
            <div class="flex items-center text-gray-500 text-sm">
                <span class="font-medium text-gray-900">{{ $contact->name }}</span>
                <span class="mx-2">&bull;</span>
                <a href="mailto:{{ $contact->email }}" class="text-indigo-600 hover:underline">{{ $contact->email }}</a>
            </div>
        </div>
        <div class="flex-shrink-0 flex items-center text-sm text-gray-500 font-medium">
            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ $contact->created_at->format('M d, Y - h:i A') }}
        </div>
    </div>
    
    <div class="p-6 sm:p-8 bg-gray-50/50">
        <div class="prose max-w-none text-gray-700 leading-relaxed whitespace-pre-wrap">
            {{ $contact->message }}
        </div>
    </div>
    
    <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-end">
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100 shadow-sm transition-colors border border-red-200">
                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                Delete Message
            </button>
        </form>
    </div>
</div>
@endsection
