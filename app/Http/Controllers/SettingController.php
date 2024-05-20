<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.edit');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token', 'web_icon');

        // Check if a new image has been uploaded
        if ($request->hasFile('web_icon')) {
            // Retrieve the current image from the settings
            $currentSetting = Setting::where('key', 'web_icon')->first();
            if ($currentSetting && $currentSetting->value) {
                $currentImagePath = public_path('storage/uploads/web_icon/' . $currentSetting->value);
                // Delete the current image file if it exists
                if (file_exists($currentImagePath)) {
                    unlink($currentImagePath);
                }
            }

            // Upload the new image
            $imageName = $this->uploadImage($request->file('web_icon'));
        }

        // Save other settings
        foreach ($data as $key => $value) {
            $setting = Setting::firstOrCreate(['key' => $key]);
            $setting->value = $value;
            $setting->save();
        }

        // Save the web_icon setting separately
        if (isset($imageName)) {
            $setting = Setting::firstOrCreate(['key' => 'web_icon']);
            $setting->value = $imageName;
            $setting->save();
        }

        return redirect()->route('settings.index')->with('status', 'Settings updated successfully!');
    }

    public function uploadImage($image)
    {
        $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $image->getClientOriginalExtension();
        $image->move(public_path('storage/uploads/web_icon'), $imageName);
        return $imageName;
    }



    // public function index()
    // {
    //     return view('settings.edit');
    // }

    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'app_name' => 'required|string|max:255',
    //         'currency_symbol' => 'required|string|max:10',
    //         'app_description' => 'required|string|max:255',
    //         'web_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1080', // Add validation rules for the logo
    //     ]);

    //     // Handle the file upload
    //     if ($request->hasFile('web_icon')) {
    //         $file = $request->file('web_icon');
    //         $fileName = 'web_icon.' . $file->getClientOriginalExtension();
    //         $file->storeAs('public/uploads/web_icon', $fileName);

    //         // Save the file name to the settings
    //         Setting::updateOrCreate(['key' => 'web_icon'], ['value' => $fileName]);
    //     }

    //     // Save other settings
    //     $data = $request->except(['_token', 'web_icon']);
    //     foreach ($data as $key => $value) {
    //         Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    //     }

    //     return redirect()->route('settings.index')->with('status', 'Setting updated successfully!');
    // }
}
