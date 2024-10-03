@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User: {{ $user->name }}</h1>
        <ul>
            <li><strong>Email:</strong> {{ $user->email }}</li>
            <li><strong>Created:</strong> {{ $user->created_at->format('d-m-Y H:i:s') }}</li>
            <li><strong>Updated:</strong> {{ $user->updated_at->format('d-m-Y H:i:s') }}</li>
        </ul>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to users</a>
    </div>
@endsection

