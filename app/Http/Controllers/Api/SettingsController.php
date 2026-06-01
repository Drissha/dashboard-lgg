<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function show()
    {
        $settings = Setting::pluck('value','key')->all();
        return response()->json(['data'=>$settings]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key'=>$key], ['value'=>$value]);
        }
        return response()->json(['message'=>'Settings updated']);
    }
}
