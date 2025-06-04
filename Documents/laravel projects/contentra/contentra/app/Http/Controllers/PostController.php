<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Store a new post
    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        // Notify all users except the one who posted
        \App\Models\User::where('id', '!=', auth()->id())->each(function ($user) use ($post) {
            $user->notify(new \App\Notifications\NewPostNotification($post));
        });

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
    
    // Delete a post
    public function destroy(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
