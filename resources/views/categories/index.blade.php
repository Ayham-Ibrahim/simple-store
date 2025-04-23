@extends('layouts.app')

@section('content')
<div class="container">
    <h1>قائمة الفئات</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">إضافة فئة جديدة</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الرقم</th>
                <th>اسم الفئة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">تعديل</a>

                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
