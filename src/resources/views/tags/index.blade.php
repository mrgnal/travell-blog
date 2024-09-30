@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tags</h1>
        <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Create Tag</a>

        @if ($tags->isEmpty())
            <p>No tags available.</p>
        @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <!-- Кнопка View -->
                            <a href="{{ route('tags.show', $tag->id) }}" class="btn btn-info">View</a>

                            <!-- Кнопка Edit -->
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning">Edit</a>

                            <!-- Кнопка Delete -->
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
