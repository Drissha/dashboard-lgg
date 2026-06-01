<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Get all sub-categories
     */
    public function index(Request $request)
    {
        try {
            $query = SubCategory::with('category');

            // Filter by category
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            $subCategories = $query->select('id', 'category_id', 'name', 'slug', 'description', 'created_at', 'updated_at')
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $subCategories,
                'message' => 'Sub-categories retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve sub-categories',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get single sub-category
     */
    public function show($id)
    {
        try {
            $subCategory = SubCategory::with('category')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $subCategory,
                'message' => 'Sub-category retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sub-category not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Create sub-category (Admin only)
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:sub_categories,slug',
                'description' => 'nullable|string',
            ]);

            $subCategory = SubCategory::create($validated);

            return response()->json([
                'success' => true,
                'data' => $subCategory->load('category'),
                'message' => 'Sub-category created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create sub-category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update sub-category (Admin only)
     */
    public function update(Request $request, $id)
    {
        try {
            $subCategory = SubCategory::findOrFail($id);

            $validated = $request->validate([
                'category_id' => 'sometimes|exists:categories,id',
                'name' => 'sometimes|string|max:255',
                'slug' => "sometimes|string|unique:sub_categories,slug,{$id}",
                'description' => 'nullable|string',
            ]);

            $subCategory->update($validated);

            return response()->json([
                'success' => true,
                'data' => $subCategory->load('category'),
                'message' => 'Sub-category updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update sub-category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete sub-category (Admin only)
     */
    public function destroy($id)
    {
        try {
            $subCategory = SubCategory::findOrFail($id);
            $subCategory->delete();

            return response()->json([
                'success' => true,
                'message' => 'Sub-category deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete sub-category',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
