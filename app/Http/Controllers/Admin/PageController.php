<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pages = Page::orderBy('created_at', 'DESC');

        if (!empty($request->keyword)) {
            $pages = $pages->where('title', 'like', '%' . $request->keyword . '%');
        }

        $data['pages'] = $pages->paginate(20);

        return view('admin.pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->all();

        $page = new Page;
        $page->slug = $request->slug;
        $page->name = $request->name;
        $page->title = $request->title;
        $page->title_ar = $request->title_ar;
        $page->subtitle = $request->subtitle;
        $page->subtitle_ar = $request->subtitle_ar;
        $page->short_des = $request->short_des;
        $page->short_des_ar = $request->short_des_ar;
        $page->content = $request->content;
        $page->content_ar = $request->content_ar;
        $page->created_by = $request->created_by;
        $page->created_by_ar = $request->created_by_ar;
        $page->developer = $request->developer;
        $page->status = $request->status;
        $page->url = $request->url;

        $page->meta_title = $request->meta_title;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;


        if ($request->hasFile('image')) {
            $uploadPath = 'public/pages';
            $file = $request->file("image");
            $ext = $file->getClientOriginalExtension();
            $filename = time() . "." . $ext;

            $path = $request->file('image')->storeAs($uploadPath, $filename);
            $page['image'] = $filename;
        }
        $page->save();

        return redirect()->route('pageList')->with('success', 'Page Created successfully');

        return response()->json([
            'status' => 200,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('admin.pages.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page = Page::where('id', $id)->first();

        if ($page == null) {
            return redirect()->route('pageList');
        }

        $data['page'] = $page;
        return view('admin.pages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->all();

        $page = Page::find($id);
        $page->slug = $request->slug;
        $page->name = $request->name;
        $page->title = $request->title;
        $page->title_ar = $request->title_ar;
        $page->subtitle = $request->subtitle;
        $page->subtitle_ar = $request->subtitle_ar;
        $page->short_des = $request->short_des;
        $page->short_des_ar = $request->short_des_ar;
        $page->content = $request->content;
        $page->content_ar = $request->content_ar;
        $page->created_by = $request->created_by;
        $page->created_by_ar = $request->created_by_ar;
        $page->developer = $request->developer;
        $page->status = $request->status;
        $page->url = $request->url;

        $page->meta_title = $request->meta_title;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;

        if ($request->hasFile('image')) {

            $uploadPath = 'storage/pages/' . $page->image;
            if (File::exists($uploadPath)) {
                unlink($uploadPath);
            }
            $file = $request->file("image");
            $ext = $file->getClientOriginalExtension();
            $filename = time() . "." . $ext;

            $file->move('storage/pages/', $filename);
            $page['image'] =  $filename;
        }
        // This will update image in DB

        $page->save();

        return redirect()->route('pageList')->with('success', 'Page Updated successfully');

        return response()->json([
            'status' => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id, Request $request)
    {

        $page = Page::where('id', $id)->first();
        File::delete('.storage/pages/' . $page->image);
        $page->delete();

        return redirect()->route('pageList')->with('success', 'Page deleted successfully');

        return response()->json([
            'status' => 200,
        ]);
    }

    public function deleteImage(Request $request)
    {
        $page = Page::find($request->id);
        $oldImage = $page->image;

        $page->image = '';
        $page->save();

        File::delete('.storage/pages/' . $oldImage);

        return response()->json([
            'status' => 200,
        ]);
    }
}
