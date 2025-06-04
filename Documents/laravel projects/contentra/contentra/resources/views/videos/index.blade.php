@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-800 text-white mb-6">🎥 All Videos</h1>

    @foreach ($videos as $video)
        <div class="bg-white shadow-md rounded-2xl p-6 mb-8">
            <h2 class="text-xl font-semibold text-blue-800">{{ $video->title }}</h2>
            <div class="mt-4 mb-4">
                <iframe src="{{ $video->url }}" class="w-full rounded-lg h-64" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="border-t pt-4 mt-4">
                <h3 class="text-lg font-medium text-gray-800">🗣️ Comments ({{ $video->comments->count() }})</h3>

                @forelse ($video->comments as $comment)
                    <div class="mt-2 p-3 bg-gray-100 rounded-md">
                        {{ $comment->body }}
                        <div class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</div>
                    </div>
                @empty
                    <p class="text-gray-500 mt-2">No comments yet.</p>
                @endforelse
            </div>

            <form method="POST" action="{{ route('videos.comments.store', $video->id) }}" class="mt-4">
                @csrf
                <textarea name="body" rows="2" class="w-full p-2 border rounded-md focus:ring" placeholder="Write a comment..."></textarea>
                @error('body')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Add Comment
                </button>
            </form>
        </div>
    @endforeach
</div>
@endsection