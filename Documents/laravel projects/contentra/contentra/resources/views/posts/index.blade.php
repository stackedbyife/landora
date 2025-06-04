@extends('layouts.app')

@section('content')
<div class=" container max-w-4xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-white">📚 All Posts</h1>

    @foreach ($posts as $post)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-primary">{{ $post->title }}</h2>
                <p class="card-text">{{ $post->content }}</p>

                <hr>
                <h5 class="mb-3">🗣️ Comments ({{ $post->comments->count() }})</h5>

                @forelse ($post->comments as $comment)
                    <div class="mb-3 p-3 bg-light rounded">
                        <p class="mb-1">{{ $comment->body }}</p>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>

                        @can('delete', $comment)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash-fill me-1"></i> Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                @empty
                    <p class="text-muted">No comments yet.</p>
                @endforelse

                <!-- Add Comment -->
                <form method="POST" action="{{ route('posts.comments.store', $post->id) }}" class="mt-4">
                    @csrf
                    <div class="mb-2">
                        <textarea name="body" rows="2" class="form-control" placeholder="Write a comment..."></textarea>
                        @error('body')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-chat-dots-fill me-1"></i> Add Comment
                    </button>
                </form>

                <!-- Post Delete Button (Only for Editor) -->
                @role('Editor')
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="mt-3" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash me-1"></i> Delete Post
                    </button>
                </form>
                @endrole
            </div>
        </div>
    @endforeach
</div>
@endsection