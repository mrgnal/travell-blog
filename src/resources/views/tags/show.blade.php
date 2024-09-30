<!-- resources/views/tags/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tag: {{ $tag->name }}</h1>
        <p>ID: {{ $tag->id }}</p>
        <p>Created at: {{ $tag->created_at }}</p>
        <p>Updated at: {{ $tag->updated_at }}</p>
    </div>
@endsection
