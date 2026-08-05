<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a new comment.
     */
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => trim($validated['comment']),
        ]);

        return back()->with('success', 'Comment added.');
    }

    /**
     * Delete a comment.
     */
    public function destroy(Comment $comment)
    {
        abort_if($comment->user_id !== auth()->id(), 403);

        $comment->delete();

        return back()->with('success', 'Comment deleted.');
    }
}
