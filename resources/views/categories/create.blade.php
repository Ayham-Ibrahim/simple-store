@extends('layouts.app')

@section('content')
<div class="container">
    <h1>إضافة فئة جديدة</h1>

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
            <label for="name" class="form-label">اسم الفئة</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection
