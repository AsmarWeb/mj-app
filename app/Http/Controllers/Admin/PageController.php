<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::orderBy('created_at', 'DESC');

        if ($request->filled('keyword')) {
            $pages->where('title', 'like', '%'.$request->keyword.'%');
        }

        $data['pages'] = $pages->paginate(20);

        return view('admin.pages.index', $data);
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:pages,slug',
            'image' => 'nullable|image|max:2048',
        ]);

        $page = new Page;

        $this->savePageData($page, $request);

        // Upload Image
        if ($request->hasFile('image')) {

            $filename = $this->uploadImage($request);

            $page->image = $filename;
        }

        $page->save();

        return redirect()
            ->route('pages.index')
            ->with('success', 'Page Created successfully');
    }

    public function edit($id)
    {
        $page = Page::find($id);

        if (! $page) {
            return redirect()
                ->route('pageList')
                ->with('error', 'Page not found');
        }

        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {

        $page = Page::find($id);

        if (! $page) {
            return redirect()
                ->route('pageList')
                ->with('error', 'Page not found');
        }

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:pages,slug,'.$page->id,
            'image' => 'nullable|image|max:2048',
        ]);

        $this->savePageData($page, $request);

        if ($request->hasFile('image')) {

            if ($page->image &&
                Storage::disk('public')->exists('pages/'.$page->image)) {

                Storage::disk('public')
                    ->delete('pages/'.$page->image);

            }

            $page->image = $this->uploadImage($request);

        }

        $page->save();

        return redirect()
            ->route('pages.index')
            ->with('success', 'Page Updated successfully');

    }

    public function delete($id)
    {

        $page = Page::find($id);

        if (! $page) {
            return redirect()
                ->route('pageList');
        }

        if ($page->image &&
            Storage::disk('public')->exists('pages/'.$page->image)) {

            Storage::disk('public')
                ->delete('pages/'.$page->image);
        }

        $page->delete();

        return redirect()
            ->route('pageList')
            ->with('success', 'Page deleted successfully');

    }

    public function deleteImage(Request $request)
    {

        $page = Page::find($request->id);

        if (! $page) {
            return response()->json([
                'status' => 404,
            ]);
        }

        if ($page->image &&
            Storage::disk('public')->exists('pages/'.$page->image)) {

            Storage::disk('public')
                ->delete('pages/'.$page->image);
        }

        $page->image = null;

        $page->save();

        return response()->json([
            'status' => 200,
        ]);

    }

    private function savePageData(Page $page, Request $request)
    {

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

        $page->status = $request->status ?? 'active';

        $page->url = $request->url;

        $page->meta_title = $request->meta_title;

        $page->meta_keywords = $request->meta_keywords;

        $page->meta_description = $request->meta_description;

    }

    private function uploadImage(Request $request)
    {

        $file = $request->file('image');

        $filename = time().'_'.$file->getClientOriginalName();

        $file->storeAs(
            'pages',
            $filename,
            'public'
        );

        return $filename;

    }
}
