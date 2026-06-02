@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h1 class="page-title">Blogs</h1>
    <a href="{{ route('admin.blogs.create') }}" class="btn">
        + Add Blog
    </a>
</div>

<div class="card mb-6">
    <div class="card-body">
        <form class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search blogs..."
                class="flex-1">
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>
    </div>
</div>

<div class="card overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="border-b">
                <th class="p-4 text-left">Image</th>
                <th class="p-4 text-left">Title</th>
                <th class="p-4 text-left">Category</th>
                <th class="p-4 text-left">Published</th>
                <th class="p-4 text-left">Status</th>
                <th class="p-4">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $blog)
                <tr class="border-b">
                    <td class="p-4">
                        @if($blog->featured_image)
                            <img
                                src="{{ Storage::url($blog->featured_image) }}"
                                class="w-14 h-14 object-cover rounded-lg border border-gray-200">
                        @endif
                    </td>
                    <td class="p-4">{{ $blog->title }}</td>
                    <td class="p-4">{{ $blog->category->name ?? '-' }}</td>
                    <td class="p-4">{{ optional($blog->published_at)->format('Y-m-d H:i') ?? '-' }}</td>
                    <td class="p-4">
                        @if($blog->status)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="flex gap-2">
                            <a
                                href="{{ route('admin.blogs.edit', $blog) }}"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                                Edit
                            </a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Delete ?')"
                                    class="px-4 py-2 bg-red-500 text-white rounded-lg">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">No blogs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $blogs->links() }}
</div>

@endsection
