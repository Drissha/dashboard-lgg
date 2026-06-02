@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h1 class="page-title">Edit Promotion</h1>
</div>

<div class="card max-w-4xl">
    <form
        action="{{ route('promotions.update', $promotion) }}"
        method="POST"
        enctype="multipart/form-data"
        class="card-body space-y-6">

        @csrf
        @method('PUT')

        @include('promotions.form')

        <div class="flex gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="btn">Update Promotion</button>
            <a href="{{ route('promotions.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection
