<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        return response()->json(Page::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|string',
            'slug'=>'required|string|unique:pages,slug',
            'meta_title'=>'nullable|string',
            'meta_description'=>'nullable|string',
            'content'=>'nullable|string',
            'featured_image'=>'nullable|string',
            'status'=>'boolean',
        ]);

        $page = Page::create($data);
        return response()->json($page,201);
    }

    public function show($id)
    {
        return response()->json(Page::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->update($request->all());
        return response()->json($page);
    }

    public function destroy($id)
    {
        Page::findOrFail($id)->delete();
        return response()->json(['message'=>'Deleted']);
    }
}
