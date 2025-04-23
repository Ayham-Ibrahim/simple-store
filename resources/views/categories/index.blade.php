@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Category List</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">edit</a>

                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
