<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        return response()->json(Blog::with('author','category')->paginate(15));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|string',
            'slug'=>'required|string|unique:blogs,slug',
            'content'=>'nullable|string',
            'featured_image'=>'nullable|string',
            'author_id'=>'nullable|exists:users,id',
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'nullable|string',
            'published_at'=>'nullable|date',
            'status'=>'boolean',
        ]);

        $blog = Blog::create($data);
        return response()->json($blog,201);
    }

    public function show($id)
    {
        return response()->json(Blog::with('author','category')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->all());
        return response()->json($blog);
    }

    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();
        return response()->json(['message'=>'Deleted']);
    }
}
