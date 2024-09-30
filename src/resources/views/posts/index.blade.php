@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Posts</h1>

        <!-- Кнопка для створення нового посту -->
        <div class="mb-3">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Create New Post</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($posts->count())
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" class="card-img-top" alt="{{ $post->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                                <p class="text-muted">By {{ $post->user->name }} | Tags:
                                    @foreach($post->tags as $tag)
                                        <span class="badge bg-primary">{{ $tag->name }}</span>
                                    @endforeach
                                </p>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read more</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        @else
            <p>No posts available.</p>
        @endif
    </div>
@endsection

