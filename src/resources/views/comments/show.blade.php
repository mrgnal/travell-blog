
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Comment Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User: {{ $comment->user->name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Post: {{ $comment->post->title }}</h6>
                <p class="card-text">{{ $comment->content }}</p>
                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
