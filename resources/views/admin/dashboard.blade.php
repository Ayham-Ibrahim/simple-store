@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h2>Dashboard</h2>
        <a href="{{ route('products.index') }}" class="btn btn-primary m-2">Products Managements</a>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary m-2">Category Managements</a>
    </div>
@endsection
