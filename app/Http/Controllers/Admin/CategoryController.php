<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Section;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
        $categoryCount = Category::count();
        return view('admin.categories.index', compact('categories', 'categoryCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $name = Section::where('id', $request->section_id)->value('name');

        $category = new Category;
        $category->code = Str::random(8);
        $category->category_name = $request->category_name;
        $category->category_name_ar = $request->category_name_ar;
        $category->parent_id = $request->parent_id;
        $category->slug = strtolower(str_replace(' ', '-', $request->category_name));
        $category->section_id = $request->section_id;
        $category->section_name = $name;
        $category->bg_color = $request->bg_color;

        if ($request->hasFile('image')) {
            $uploadPath = 'public/category-suggest';
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($uploadPath, $imageName);
            $category['image'] = $imageName;
        }

        $category->save();

        return redirect()->route('categories.index')->with('message', 'Category Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category_info = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category_info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $name = Section::where('id', $request->section_id)->value('name');

        $category = Category::find($id);
        $category->code = Str::random(8);
        $category->category_name = $request->category_name;
        $category->category_name_ar = $request->category_name_ar;
        $category->parent_id = $request->parent_id;
        $category->slug = strtolower(str_replace(' ', '-', $request->category_name));
        $category->section_id = $request->section_id;
        $category->section_name = $name;
        $category->bg_color = $request->bg_color;

        if ($request->hasFile('image')) {
            $uploadPath = 'storage/category-suggest/' . $category->image;
            if (File::exists($uploadPath)) {
                unlink($uploadPath);
            }
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move('storage/category-suggest/', $imageName);
            $category['image'] = $imageName;
        }

        $category->update();

        return redirect()->route('categories.index')->with('message', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('message', 'Category deleted Successfully');
    }
}
