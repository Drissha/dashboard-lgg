<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        return response()->json(Banner::orderBy('sort_order')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|string',
            'description'=>'nullable|string',
            'image'=>'nullable|string',
            'button_text'=>'nullable|string',
            'button_link'=>'nullable|string',
            'status'=>'boolean',
            'sort_order'=>'integer',
        ]);

        $banner = Banner::create($data);
        return response()->json($banner,201);
    }

    public function show($id)
    {
        return response()->json(Banner::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update($request->all());
        return response()->json($banner);
    }

    public function destroy($id)
    {
        Banner::findOrFail($id)->delete();
        return response()->json(['message'=>'Deleted']);
    }
}
