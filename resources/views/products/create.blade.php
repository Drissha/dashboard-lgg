@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h1 class="page-title">Create Product</h1>
</div>

<div class="card max-w-4xl">
    <form
        action="{{ route('products.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="card-body space-y-6">

        @csrf

        @include('products.form')

        <div class="flex gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="btn">Save Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
</div>

@endsection