<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::find(1);

        return view('admin.settings.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return view('admin.settings.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->all();

        $setting = Setting::find($id);

        $setting->phone = $request->phone;
        $setting->phone2 = $request->phone2;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->short_des = $request->short_des;
        $setting->short_des_ar = $request->short_des_ar;
        $setting->description = $request->description;
        $setting->description_ar = $request->description_ar;

        $setting->facebook = $request->facebook;
        $setting->instagram = $request->instagram;
        $setting->telegram = $request->telegram;
        $setting->tiktok = $request->tiktok;

        $setting->copyright = $request->copyright;
        $setting->copyright_ar = $request->copyright_ar;

         // Maintenance Mode
        $setting->maintenance_mode = $request->boolean('maintenance_mode');

        $setting->map = $request->map;

        if ($request->hasFile('logo')) {
            $uploadPath = 'storage/setting-suggest/'.$setting->logo;
            if (File::exists($uploadPath)) {
                unlink($uploadPath);
            }
            $image = $request->file('logo');
            $imageName = $image->getClientOriginalName();
            $image->move('storage/setting-suggest/', $imageName);
            $setting['logo'] = $imageName;
        }

        if ($request->hasFile('favicon')) {
            $uploadPath = 'storage/setting-suggest/'.$setting->favicon;
            if (File::exists($uploadPath)) {
                unlink($uploadPath);
            }
            $image = $request->file('favicon');
            $imageName = $image->getClientOriginalName();
            $image->move('storage/setting-suggest/', $imageName);
            $setting['favicon'] = $imageName;
        }

        $setting->update();

        return redirect()->route('settings.index')->with('message', 'Setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
