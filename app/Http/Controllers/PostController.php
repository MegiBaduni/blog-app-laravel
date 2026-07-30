<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
public function index()
{
    $posts = Post::paginate(5);
    return view('posts', ['posts' => $posts]);
}

    public function create()
    {
        return view('create-post');
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        Post::create($validated);

        return redirect('/hello');
        public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    $validated['user_id'] = auth()->id();

    $post = Post::create($validated);

    return response()->json($post, 201);
}
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);

        $post->delete();

        return redirect('/hello');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        return view('edit-post', ['post' => $post]);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        $post->update($request->validated());

        return redirect('/hello');
    }
}