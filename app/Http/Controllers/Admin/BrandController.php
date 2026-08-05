<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\SubCategory;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(5);

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {

        $subcategory_name = SubCategory::where('id', $request->subcategory_id)->value('subcategory_name');

        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->brand_name_ar = $request->brand_name_ar;
        $brand->slug = strtolower(str_replace(' ', '-', $request->brand_name));
        $brand->subcategory_id = $request->subcategory_id;
        $brand->subcategory_name = $subcategory_name;

        $brand->save();

        return redirect()->route('brands.index')->with('message', 'Brand Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('admin.brands.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand_info = Brand::findOrFail($id);

        return view('admin.brands.edit', compact('brand_info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        $subcategory_name = SubCategory::where('id', $request->subcategory_id)->value('subcategory_name');

        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;
        $brand->brand_name_ar = $request->brand_name_ar;
        $brand->slug = strtolower(str_replace(' ', '-', $request->brand_name));
        $brand->subcategory_id = $request->subcategory_id;
        $brand->subcategory_name = $subcategory_name;

        $brand->update();

        return redirect()->route('brands.index')->with('message', 'Brand Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('brands.index')->with('message', 'Brand deleted Successfully');
    }
}
