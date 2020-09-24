<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index()
    {
        return Post::latest()
            ->with('author', function ($query) {
                $query->select(['id', 'name']);
            })
            ->get(['id', 'user_id', 'title', 'published', 'created_at']);
    }

    function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return $post;
    }

    function show(Post $post)
    {
        return $post->load([
            'author',
            'comments' => function ($query) {
                $query->orderBy('salient', 'desc')->orderBy('created_at', 'desc');
            },
            'comments.user'
        ]);
    }

    function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return $post;
    }

    function destroy(Post $post)
    {
        $post->delete();

        return response(null, 204);
    }

    function publish(Post $post)
    {
        $post->update([
            'published' => true,
        ]);

        return $post;
    }

    function unpublish(Post $post)
    {
        $post->update([
            'published' => false,
        ]);

        return $post;
    }
}
