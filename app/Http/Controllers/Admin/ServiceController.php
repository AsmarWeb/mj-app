<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::paginate(3);
        $serviceCount = Service::count();

        return view('admin.services.index', compact('services', 'serviceCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->all();

        $service = new Service;

        $service->title = $request->title;
        $service->description = $request->description;
        $service->bg_color = $request->bg_color;

        $service->save();

        return redirect()->route('services.index')->with('message', 'Service Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('admin.services.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service_info = Service::findOrFail($id);

        return view('admin.services.edit', compact('service_info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        $service->title = $request->title;
        $service->description = $request->description;
        $service->bg_color = $request->bg_color;

        $service->update();

        return redirect()->route('services.index')->with('message', 'Service Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->with('message', 'Service deleted Successfully');
    }
}
