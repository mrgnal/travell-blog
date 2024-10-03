<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }
    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:tags,name',
        ]);

        Tag::create([
            'name' => $validateData['name'],
        ]);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }
    public function show(string $id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.show', compact('tag'));
    }
    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:tags,name,'.$id,
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update([
            'name' => $validateData['name'],
        ]);

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
