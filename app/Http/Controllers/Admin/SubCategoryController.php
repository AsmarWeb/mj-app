<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::paginate(5);
        $subcategoryCount = SubCategory::count();

        return view('admin.subcategories.index', compact('subcategories', 'subcategoryCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $category_name = Category::where('id', $request->category_id)->value('category_name');

        $subcategory = new SubCategory;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->subcategory_name_ar = $request->subcategory_name_ar;
        $subcategory->slug = strtolower(str_replace(' ', '-', $request->subcategory_name));
        $subcategory->category_id = $request->category_id;
        $subcategory->category_name = $category_name;

        $subcategory->save();

        return redirect()->route('subcategories.index')->with('message', 'SubCategory Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        return view('admin.subcategories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subcategory_info = SubCategory::findOrFail($id);

        return view('admin.subcategories.edit', compact('subcategory_info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, $id)
    {
        $category_name = Category::where('id', $request->category_id)->value('category_name');

        $subcategory = SubCategory::find($id);

        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->subcategory_name_ar = $request->subcategory_name_ar;
        $subcategory->slug = strtolower(str_replace(' ', '-', $request->subcategory_name));
        $subcategory->category_id = $request->category_id;
        $subcategory->category_name = $category_name;

        $subcategory->update();

        return redirect()->route('subcategories.index')->with('message', 'SubCategory Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();

        return redirect()->route('subcategories.index')->with('message', 'SubCategory deleted Successfully');
    }
}
