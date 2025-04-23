@extends('layouts.app')

@section('content')
<div class="container">
    <h1>add new category</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">category name</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <button type="submit" class="btn btn-primary">save</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">cancel</a>
    </form>
</div>
@endsection
