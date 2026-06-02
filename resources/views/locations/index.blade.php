@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h1 class="page-title">Locations</h1>
    <a href="{{ route('locations.create') }}" class="btn">
        + Add Location
    </a>
</div>

<form class="mb-6">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search Location..."
        class="border rounded-xl px-4 py-3">

</form>

<div class="card overflow-hidden">

    <table>

        <thead>
            <tr>
                <th>Image</th>
                <th>Location Name</th>
                <th>Phone</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($locations as $location)
                <tr>
                    <td>
                        @if($location->image)
                            <img
                                src="{{ Storage::url($location->image) }}"
                                alt="{{ $location->name }}"
                                class="w-16 h-16 object-cover rounded-xl border">
                        @else
                            <div class="w-16 h-16 rounded-xl border bg-gray-100 flex items-center justify-center text-xs text-gray-400">
                                No Image
                            </div>
                        @endif
                    </td>
                    <td class="font-medium">
                        <div>{{ $location->name }}</div>
                        <div class="text-xs text-gray-500 mt-1">
                            Open Shop: {{ $location->open_shop ?: '-' }} |
                            Kota: {{ $location->kota ?: '-' }} |
                            Daerah: {{ $location->daerah ?: '-' }}
                        </div>
                    </td>
                    <td class="text-gray-600">{{ $location->phone }}</td>
                    <td class="text-right">
                        <div class="flex gap-2 justify-end">
                            <a
                                href="{{ route('locations.edit',$location) }}"
                                class="btn btn-secondary text-xs px-3 py-1">
                                Edit
                            </a>
                            <form
                                action="{{ route('locations.destroy',$location) }}"
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
                    <td colspan="4" class="text-center py-8 text-gray-500">No locations found</td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>

@endsection
