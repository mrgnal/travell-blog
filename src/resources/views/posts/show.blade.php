@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>

        @if($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="img-fluid mb-3">
        @endif

        <p>{{ $post->content }}</p>

        <p class="text-muted">Posted by {{ $post->user->name }} | Location: {{ $post->location ?? 'N/A' }}</p>

        <p>Tags:
            @foreach($post->tags as $tag)
                <span class="badge bg-primary">{{ $tag->name }}</span>
            @endforeach
        </p>

        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary">Edit Post</a>

        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this post?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Post</button>
        </form>

        <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">Back to Posts</a>
    </div>
@endsection
