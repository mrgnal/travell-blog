<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        $users = User::all();
        $posts = Post::all();
        return view('comments.create', compact('users', 'posts'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);

        Comment::create([
            'content' => $validateData['content'],
            'user_id' => $validateData['user_id'],
            'post_id' => $validateData['post_id'],
        ]);

        return redirect()->route('comments.index')->with('success', 'Comment created successfully.');
    }


    public function show(string $id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.show', compact('comment'));
    }

    public function edit(string $id)
    {
        $comment = Comment::findOrFail($id);
        $users = User::all();
        $posts = Post::all();
        return view('comments.edit', compact('comment', 'users', 'posts'));
    }


    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update([
            'content' => $validateData['content'],
            'user_id' => $validateData['user_id'],
            'post_id' => $validateData['post_id'],
        ]);

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully.');
    }

    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully.');
    }
}
