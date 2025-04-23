@extends('layouts.app')

@section('content')
<div class="container">
    <h2>كل المنتجات</h2>
    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">إضافة منتج</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الصورة</th>
                <th>الاسم</th>
                <th>الوصف</th>
                <th>السعر</th>
                <th>التحكم</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td><img src="{{ asset('storage/' . $product->image) }}" width="60"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }} د.ل</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
