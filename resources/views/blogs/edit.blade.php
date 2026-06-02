@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h1 class="page-title">Edit Blog</h1>
</div>

<div class="card max-w-4xl">
    <form
        action="{{ route('admin.blogs.update', $blog) }}"
        method="POST"
        enctype="multipart/form-data"
        class="card-body space-y-6">

        @csrf
        @method('PUT')

        @include('blogs.form')

        <div class="flex gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="btn">Update Blog</button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection
