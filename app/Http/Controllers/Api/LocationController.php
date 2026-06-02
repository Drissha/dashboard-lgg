<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Get all locations
     */
    public function index()
    {
        try {
            $locations = Location::select(
                'id',
                'name',
                'phone',
                'address',
                'open_shop',
                'kota',
                'daerah',
                'google_maps_url',
                'description',
                'created_at',
                'updated_at'
            )
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $locations,
                'message' => 'Locations retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve locations',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get single location by ID
     */
    public function show($id)
    {
        try {
            $location = Location::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $location,
                'message' => 'Location retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Location not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Create new location (Admin only)
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string',
                'address' => 'required|string',
                'open_shop' => 'nullable|string|max:255',
                'kota' => 'nullable|string|max:255',
                'daerah' => 'nullable|string|max:255',
                'google_maps_url' => 'nullable|url',
                'description' => 'nullable|string',
            ]);

            $location = Location::create($validated);

            return response()->json([
                'success' => true,
                'data' => $location,
                'message' => 'Location created successfully'
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create location',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update location (Admin only)
     */
    public function update(Request $request, $id)
    {
        try {
            $location = Location::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'phone' => 'sometimes|string',
                'address' => 'sometimes|string',
                'open_shop' => 'nullable|string|max:255',
                'kota' => 'nullable|string|max:255',
                'daerah' => 'nullable|string|max:255',
                'google_maps_url' => 'nullable|url',
                'description' => 'nullable|string',
            ]);

            $location->update($validated);

            return response()->json([
                'success' => true,
                'data' => $location,
                'message' => 'Location updated successfully'
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update location',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete location (Admin only)
     */
    public function destroy($id)
    {
        try {
            $location = Location::findOrFail($id);
            $location->delete();

            return response()->json([
                'success' => true,
                'message' => 'Location deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete location',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
