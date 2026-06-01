<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::query()

            ->when(request('search'), function ($query) {

                $query->where('name', 'like', '%' . request('search') . '%');

            })

            ->latest()
            ->paginate(10);

        return view(
            'locations.index',
            compact('locations')
        );
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(
        StoreLocationRequest $request
    ) {

        $data = $request->validated();

        if ($request->hasFile('image')) {

            $data['image'] = $request
                ->file('image')
                ->store('locations', 'public');
        }

        Location::create($data);

        return redirect()
            ->route('locations.index');
    }

    public function edit(Location $location)
    {
        return view(
            'locations.edit',
            compact('location')
        );
    }

    public function update(
        UpdateLocationRequest $request,
        Location $location
    ) {

        $data = $request->validated();

        if ($request->hasFile('image')) {

            if ($location->image) {

                Storage::disk('public')
                    ->delete($location->image);
            }

            $data['image'] = $request
                ->file('image')
                ->store('locations', 'public');
        }

        $location->update($data);

        return redirect()
            ->route('locations.index');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return back();
    }
}