<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::paginate(3);
        $featureCount = Feature::count();

        return view('admin.features.index', compact('features', 'featureCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->all();

        $feature = new Feature;

        $feature->title = $request->title;
        $feature->short_des = $request->short_des;
        $feature->description = $request->description;

        $feature->save();

        return redirect()->route('features.index')->with('message', 'Feature Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        return view('admin.features.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $feature_info = Feature::findOrFail($id);

        return view('admin.features.edit', compact('feature_info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $feature = Feature::find($id);
        $feature->title = $request->title;
        $feature->short_des = $request->short_des;
        $feature->description = $request->description;

        $feature->update();

        return redirect()->route('features.index')->with('message', 'Feature Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();

        return redirect()->route('features.index')->with('message', 'Feature deleted Successfully');
    }
}
