<?php

namespace App\Http\Controllers\Backend;

use App\Models\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogcategories = BlogCategory::orderBy('id', 'DESC')->paginate(20);

        return view('backend.blogcategory.all', compact('blogcategories', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blogcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blogcategory = new BlogCategory();

        if ($request->hasFile('images')) {
            $image    = $request->file('images');
            $filename = 'blog-category-'.time() . '.' . $image->getClientOriginalExtension();
            $path     = public_path('upload/blog/' . $filename);
            Image::make($request->file('images')->getRealPath())->save($path);
            $request['image'] = $filename;
        }

        $new_id = $blogcategory->create($request->all())->id;

        return redirect()->route('blog-category.index')->with(['success' => 'Ekleme işleminiz başarılı.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $blogcategory = BlogCategory::find($request->id);

        if ($blogcategory) {
            return view('backend.blogcategory.edit', compact('blogcategory', 'request'));
        }

        return redirect()->route('blog-category.index')->withError('Kategori bulunamadı!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $blogcategory = BlogCategory::find($request->id);

        if ($blogcategory) {
            if ($request->hasFile('images')) {
                $image    = $request->file('images');
                $filename = 'blog-category-'.time() . '.' . $image->getClientOriginalExtension();
                $path     = public_path('upload/blog/' . $filename);
                Image::make($request->file('images')->getRealPath())->save($path);
                $request['image'] = $filename;
            }

            $blogcategory->update($request->all());

            return redirect()->route('blog-category.index')->with(['success' => 'Güncelleme işleminiz başarılı.']);
        }

        return redirect()->route('blog-category.index')->withError('Kategori bulunamadı!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $blogcategory = BlogCategory::find($request->id);

        if ($blogcategory) {
            $blogcategory->delete();

            return redirect()->route('blog-category.index')->with(['success' => 'Silme işleminiz başarılı.']);
        }

        return redirect()->route('blog-category.index')->withError('Kategori bulunamadı!');
    }
}
