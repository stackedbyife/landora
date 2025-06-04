@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
<h1 class="text-2xl font-bold mb-6 text-white">Admin - Manage Posts</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($posts as $post)
        <div class="bg-white shadow rounded p-4 mb-4">
            <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
            <p class="text-gray-600 mt-1">{{ $post->body }}</p>
            <div class="mt-4">
                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-500">No posts available.</p>
    @endforelse
</div>
@endsection