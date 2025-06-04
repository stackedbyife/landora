<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AdminCommentController extends BaseController
{
    public function __construct()
    {
        $this->middleware('role:Admin');
    }

    // Show all comments
    public function index()
    {
        $comments = Comment::with('user')->latest()->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }

    // Delete a comment
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully.');
    }
}