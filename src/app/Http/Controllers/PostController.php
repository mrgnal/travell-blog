<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'tags'])->paginate(10);
        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        $tags = Tag::all();
        $users = User::all();
        return view('posts.create', compact('tags', 'users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|max:2048',
            'location' => 'nullable|string',
            'tags' => 'nullable|array',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        $post = Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => $validatedData['user_id'],
            'image_path' => $imagePath,
            'location' => $validatedData['location'],
        ]);

        if ($request->tags) {
            $post->tags()->attach($validatedData['tags']);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }


    public function show(string $id)
    {
        $post = Post::with('tags')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

     public function edit(string $id)
    {
        $post = Post::with('tags')->findOrFail($id);
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'tags'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'location' => 'nullable|string',
            'tags' => 'nullable|array',
        ]);

        $post = Post::findOrFail($id);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : $post->image_path;

        $post->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'location' => $validatedData['location'],
            'image_path' => $imagePath,
        ]);

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if ($post->image_path) {
            Storage::delete('public/' . $post->image_path);
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
