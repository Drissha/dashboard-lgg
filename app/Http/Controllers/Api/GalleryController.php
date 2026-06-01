<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        return response()->json(Gallery::latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|string',
            'image'=>'required|string',
            'category'=>'nullable|string',
            'description'=>'nullable|string',
        ]);

        $gallery = Gallery::create($data);
        return response()->json($gallery,201);
    }

    public function destroy($id)
    {
        Gallery::findOrFail($id)->delete();
        return response()->json(['message'=>'Deleted']);
    }
}
