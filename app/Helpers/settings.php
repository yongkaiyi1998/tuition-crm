<?php

use App\Models\Setting;

function setting(string $key, $default = null)
{
    $setting = Setting::where('key', $key)->first();

    return $setting ? $setting->value : $default;
}