<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    /**
     * Get all promotions.
     */
    public function index(Request $request)
    {
        try {
            $query = Promotion::query();

            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }

            if ($request->has('active')) {
                $query->where('active', $request->boolean('active'));
            }

            $promotions = $query->latest()->paginate($request->get('per_page', 10));

            return response()->json([
                'success' => true,
                'data' => $promotions,
                'message' => 'Promotions retrieved successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve promotions',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get a single promotion.
     */
    public function show($id)
    {
        try {
            $promotion = Promotion::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $promotion,
                'message' => 'Promotion retrieved successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Promotion not found',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Store a promotion.
     */
    public function store(StorePromotionRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('images')) {
                $data['images'] = collect($request->file('images'))
                    ->map(fn ($image) => $image->store('promotions', 'public'))
                    ->values()
                    ->all();
            }

            $promotion = Promotion::create($data);

            return response()->json([
                'success' => true,
                'data' => $promotion,
                'message' => 'Promotion created successfully',
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create promotion',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update a promotion.
     */
    public function update(UpdatePromotionRequest $request, $id)
    {
        try {
            $promotion = Promotion::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('images')) {
                if (! empty($promotion->images)) {
                    foreach ($promotion->images as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }

                $data['images'] = collect($request->file('images'))
                    ->map(fn ($image) => $image->store('promotions', 'public'))
                    ->values()
                    ->all();
            } else {
                unset($data['images']);
            }

            $promotion->update($data);

            return response()->json([
                'success' => true,
                'data' => $promotion->fresh(),
                'message' => 'Promotion updated successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update promotion',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a promotion.
     */
    public function destroy($id)
    {
        try {
            $promotion = Promotion::findOrFail($id);

            if (! empty($promotion->images)) {
                foreach ($promotion->images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            $promotion->delete();

            return response()->json([
                'success' => true,
                'message' => 'Promotion deleted successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete promotion',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
