<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pages = Page::orderBy('id', 'DESC')->paginate(20);

        return view('backend.page.all', compact('pages', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('images')) {
            $image    = $request->file('images');
            $filename = 'blog-'.time() . '.' . $image->getClientOriginalExtension();
            $path     = public_path('upload/blog/' . $filename);
            Image::make($request->file('images')->getRealPath())->save($path);
            $request['image'] = $filename;
        }

        $page = new Page();

        $new_id = $page->create($request->all())->id;

        return redirect()->route('page.index')->with(['success' => 'Ekleme işleminiz başarılı.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $page = Page::find($request->id);
        if ($page) {
            return view('backend.page.edit', compact('page', 'request'));
        }

        return redirect()->route('page.index')->withError('Sayfa bulunamadı!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $page = Page::find($request->id);

        if ($page) {
            if ($request->hasFile('images')) {
                $image    = $request->file('images');
                $filename = 'page-'.time() . '.' . $image->getClientOriginalExtension();
                $path     = public_path('upload/page/' . $filename);
                Image::make($request->file('images')->getRealPath())->save($path);
                $request['image'] = $filename;
            }

            $page->update($request->all());

            return redirect()->route('page.index')->with(['success' => 'Güncelleme işleminiz başarılı.']);
        }

        return redirect()->route('page.index')->withError('Sayfa bulunamadı!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $page = Page::find($request->id);
        if ($page) {

            $page->delete();

            return redirect()->route('page.index')->with(['success' => 'Silme işleminiz başarılı.']);
        }

        return redirect()->route('page.index')->withError('Sayfa bulunamadı!');
    }
}
