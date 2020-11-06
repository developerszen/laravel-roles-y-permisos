<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = Comment::create([
            'user_id' => $request->user()->id,
            'post_id' => $post->id,
            'content' => $request->input('comment'),
        ]);

        return $comment;
    }

    function salient(Post $post, Comment $comment)
    {
        Comment::where('salient', true)->update([
            'salient' => false,
        ]);

        $comment->update([
            'salient' => true,
        ]);

        return $comment;
    }
}
