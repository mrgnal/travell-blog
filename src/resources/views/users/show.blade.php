@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        @if ($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="img-fluid">
        @endif
        <p>{{ $post->content }}</p>
        <p>Автор: {{ $post->user->name }}</p>
        <p>Місцезнаходження: {{ $post->location }}</p>
        <a href="{{ route('posts.index') }}" class="btn btn-primary">Назад до постів</a>
    </div>
@endsection
