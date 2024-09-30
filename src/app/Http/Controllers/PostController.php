<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user', 'tags'])->paginate(10); // Завантажуємо разом з тегами
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        $users = User::all();
        return view('posts.create', compact('tags', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required', // Поле обов'язкове
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|max:2048', // Додано валідацію зображення
            'location' => 'nullable|string',
        ]);

        // Збереження зображення
        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        Post::create([
            'title' => $request->title,
            'content' => $validatedData['content'], // Додається перевірене значення
            'user_id' => $request->user_id,
            'image_path' => $imagePath,
            'location' => $request->location,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('tags')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::with('tags')->findOrFail($id);
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048', // Валідація зображення
            'location' => 'nullable|string',
        ]);

        $post = Post::findOrFail($id);

        // Збереження зображення, якщо воно було завантажене
        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : $post->image_path;

        $post->update([
            'title' => $request->title,
            'content' => $validatedData['content'],
            'location' => $request->location,
            'image_path' => $imagePath,
        ]);


        // Оновлюємо теги
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // Видаляємо зображення, якщо воно існує
        if ($post->image_path) {
            Storage::delete('public/' . $post->image_path);
        }

        $post->tags()->detach(); // Від'єднуємо всі теги
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
