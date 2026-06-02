@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h1 class="page-title">Promotions</h1>
    <a href="{{ route('promotions.create') }}" class="btn">
        + Add Promotion
    </a>
</div>

<div class="card mb-6">
    <div class="card-body">
        <form class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search promotions..."
                class="flex-1">
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>
    </div>
</div>

<div class="card overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="border-b">
                <th class="p-4 text-left">Images</th>
                <th class="p-4 text-left">Name</th>
                <th class="p-4 text-left">Datetime</th>
                <th class="p-4 text-left">Status</th>
                <th class="p-4">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($promotions as $promotion)
                <tr class="border-b">
                    <td class="p-4">
                        <div class="flex gap-2 flex-wrap">
                            @foreach(($promotion->images ?? []) as $image)
                                <img
                                    src="{{ Storage::url($image) }}"
                                    class="w-14 h-14 object-cover rounded-lg border border-gray-200">
                            @endforeach
                        </div>
                    </td>
                    <td class="p-4">{{ $promotion->name }}</td>
                    <td class="p-4">
                        {{ optional($promotion->datetime)->format('Y-m-d H:i') ?? '-' }}
                    </td>
                    <td class="p-4">
                        @if($promotion->active)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="flex gap-2">
                            <a
                                href="{{ route('promotions.edit', $promotion) }}"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                                Edit
                            </a>
                            <form action="{{ route('promotions.destroy', $promotion) }}" method="POST">
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
                    <td colspan="5" class="p-4 text-center text-gray-500">No promotions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $promotions->links() }}
</div>

@endsection
