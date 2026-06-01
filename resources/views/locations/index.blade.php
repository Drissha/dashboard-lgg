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
                <th>Location Name</th>
                <th>Phone</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($locations as $location)
                <tr>
                    <td class="font-medium">{{ $location->name }}</td>
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
                    <td colspan="3" class="text-center py-8 text-gray-500">No locations found</td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>

@endsection