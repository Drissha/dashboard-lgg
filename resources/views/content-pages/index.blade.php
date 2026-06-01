@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h1 class="page-title">Content Pages</h1>
    <a
        href="{{ route('content-pages.create') }}"
        class="btn">
        + Add Page
    </a>
</div>

<div class="card mb-6">
    <div class="card-body">
        <form class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search pages..."
                class="flex-1">
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>
    </div>
</div>

<div class="card overflow-hidden">

    <table>

        <thead>
            <tr>
                <th>Page Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pages as $page)
                <tr>
                    <td class="font-medium">{{ $page->title }}</td>
                    <td class="text-gray-500 text-sm">{{ $page->slug }}</td>
                    <td>
                        <span class="badge {{ $page->status ? 'badge-success' : '' }}">
                            {{ $page->status ? 'Active' : 'Draft' }}
                        </span>
                    </td>
                    <td class="text-right">
                        <div class="flex gap-2 justify-end">
                            <a
                                href="{{ route('content-pages.edit',$page) }}"
                                class="btn btn-secondary text-xs px-3 py-1">
                                Edit
                            </a>
                            <form
                                action="{{ route('content-pages.destroy',$page) }}"
                                method="POST"
                                class="inline"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-xs px-3 py-1">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-8 text-gray-500">No pages found</td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>

{{ $pages->links() }}

@endsection