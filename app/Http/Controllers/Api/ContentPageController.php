<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentPage;
use Illuminate\Support\Facades\Storage;

class ContentPageController extends Controller
{
    /**
     * Display all content pages
     */
    public function index(Request $request)
    {
        $query = ContentPage::query();

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->boolean('status'));
        }

        // Search
        if ($request->has('search')) {
            $query->where('title', 'like', "%{$request->search}%")
                  ->orWhere('slug', 'like', "%{$request->search}%")
                  ->orWhere('content', 'like', "%{$request->search}%");
        }

        // Get by slug (for frontend)
        if ($request->has('slug')) {
            return response()->json([
                'success' => true,
                'data' => $query->where('slug', $request->slug)->firstOrFail(),
                'message' => 'Content page retrieved successfully'
            ]);
        }

        $pages = $query->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $pages,
            'message' => 'Content pages retrieved successfully'
        ]);
    }

    /**
     * Store a new content page
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:content_pages,slug',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('content-pages', 'public');
        }

        $page = ContentPage::create($validated);

        return response()->json([
            'success' => true,
            'data' => $page,
            'message' => 'Content page created successfully'
        ], 201);
    }

    /**
     * Get a specific content page
     */
    public function show($id)
    {
        $page = ContentPage::find($id);

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'Content page not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $page,
            'message' => 'Content page retrieved successfully'
        ]);
    }

    /**
     * Update a content page
     */
    public function update(Request $request, $id)
    {
        $page = ContentPage::find($id);

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'Content page not found'
            ], 404);
        }

        $validated = $request->validate([
            'page_name' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            'slug' => "sometimes|string|unique:content_pages,slug,{$id}",
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($page->featured_image) {
                Storage::disk('public')->delete($page->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('content-pages', 'public');
        }

        $page->update($validated);

        return response()->json([
            'success' => true,
            'data' => $page,
            'message' => 'Content page updated successfully'
        ]);
    }

    /**
     * Delete a content page
     */
    public function destroy($id)
    {
        $page = ContentPage::find($id);

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'Content page not found'
            ], 404);
        }

        // Delete image
        if ($page->featured_image) {
            Storage::disk('public')->delete($page->featured_image);
        }

        $page->delete();

        return response()->json([
            'success' => true,
            'message' => 'Content page deleted successfully'
        ]);
    }
}
