<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->comments()->create($validated);

        return redirect('/hello');
    }
}