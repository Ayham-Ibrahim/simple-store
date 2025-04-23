@extends('layouts.app')

@section('content')
<div class="container">
    <h2><b>Add Product</b></h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('products.form')
        <button class="btn btn-success">حفظ</button>
    </form>
</div>
@endsection
