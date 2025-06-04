<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    //
    public function posts()
    {
        $posts = Post::with('comments')->get();
        return view('posts.index', compact('posts'));
    }
    public function videos()
    {
        $videos = Video::with('comments')->get();
        return view('videos.index', compact('videos'));
    }

    public function storePostComment(Request $request, Post $post)
    {
        $request->validate(['body' => 'required|string']);
        $post->comments()->create(['body' => $request->body]);
        return back();
    }

    public function storeVideoComment(Request $request, Video $video)
    {
        $request->validate(['body' => 'required|string']);
        $video->comments()->create(['body' => $request->body]);
        return back();
    }
        public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
