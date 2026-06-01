<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function getAll()
    {
        return Setting::pluck('value','key')->all();
    }

    public function update(array $data)
    {
        foreach ($data as $k=>$v) {
            Setting::updateOrCreate(['key'=>$k], ['value'=>$v]);
        }
    }
}
