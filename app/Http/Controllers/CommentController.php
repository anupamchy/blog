<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Blog $blog)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $blog->comments()->create([
            'student_id' => auth()->guard('student')->id(),
            'content' => $request->content,
        ]);

        return back();
    }

    public function replyStore(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment->replies()->create([
            'student_id' => auth()->guard('student')->id(),
            'blog_id' => $comment->blog_id,
            'content' => $request->content,
        ]);

        return back();
    }
}
