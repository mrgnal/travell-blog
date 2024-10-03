
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Comments</h1>
        <a href="{{ route('comments.create') }}" class="btn btn-primary">Add Comment</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Content</th>
                <th>User</th>
                <th>Post</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->post->title }}</td>
                    <td>
                        <a href="{{ route('comments.show', $comment->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
