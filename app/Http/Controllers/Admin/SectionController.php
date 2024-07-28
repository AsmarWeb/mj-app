<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use Illuminate\Support\Facades\File;
use App\Models\Section;

class SectionController extends Controller
{
    public $section;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::paginate(5);
        $sectionCount = Section::count();

        if (request()->has('search')) {
            $sections->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        return view('admin.sections.index', compact('sections', 'sectionCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSectionRequest $request)
    {
        $section = new Section;
        $section->name = $request->name;
        $section->name_ar = $request->name_ar;
        $section->slug = strtolower(str_replace(' ', '-', $request->name));

        if ($request->hasFile('image')) {
            $uploadPath = 'public/section-suggest';
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($uploadPath, $imageName);
            $section['image'] = $imageName;
        }

        $section->save();

        return redirect()->route('sections.index')->with('message', 'Sections Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('admin.sections.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $section_info = Section::findOrFail($id);
        return view('admin.sections.edit', compact('section_info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionRequest $request, $id)
    {
        $section = Section::find($id);
        $section->name = $request->name;
        $section->name_ar = $request->name_ar;
        $section->slug = strtolower(str_replace(' ', '-', $request->name));

        if ($request->hasFile('image')) {
            $uploadPath = 'storage/section-suggest/' . $section->image;
            if (File::exists($uploadPath)) {
                unlink($uploadPath);
            }
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move('storage/section-suggest/', $imageName);
            $section['image'] = $imageName;
        }

        $section->update();

        return redirect()->route('sections.index')->with('message', 'Sections Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('message', 'Section deleted Successfully');
    }
}
