@extends('layouts.app')

@section('content')
<div class="container">
    <h1>تعديل الفئة</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">اسم الفئة</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $category->name) }}">
        </div>
        <button type="submit" class="btn btn-success">تحديث</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection
