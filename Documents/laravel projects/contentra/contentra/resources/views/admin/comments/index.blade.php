@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Admin - Manage Comments</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($comments as $comment)
        <div class="bg-white shadow rounded p-4 mb-4">
            <p class="text-gray-800">{{ $comment->body }}</p>
            <p class="text-sm text-gray-500 mt-1">By {{ $comment->user->name ?? 'Guest' }} on {{ $comment->created_at->format('M d, Y H:i') }}</p>

            <div class="mt-4">
                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-500">No comments found.</p>
    @endforelse
</div>
@endsection