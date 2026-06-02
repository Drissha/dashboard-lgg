<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateSettingRequest;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view(
            'setting.index',
            compact('setting')
        );
    }

    public function update(
        UpdateSettingRequest $request
    ) {

        $setting = Setting::first() ?? new Setting();

        $data = $request->validated();

        if ($request->hasFile('logo')) {

            if ($setting->logo) {

                Storage::disk('public')
                    ->delete($setting->logo);
            }

            $data['logo'] = $request
                ->file('logo')
                ->store('settings', 'public');
        }

        $setting->fill($data);
        $setting->save();

        return back()
            ->with('success', 'Updated');
    }
}
