@extends('layouts.app')

@section('content')
<div class="container">
    <h2>تعديل منتج</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.products.form', ['product' => $product])
        <button class="btn btn-primary">تحديث</button>
    </form>
</div>
@endsection
