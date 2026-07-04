<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all()->keyBy('key');

    return view('settings.index', compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );

        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
