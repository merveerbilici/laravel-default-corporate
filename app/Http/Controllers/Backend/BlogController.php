<?php

namespace App\Http\Controllers\Backend;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogs = Blog::orderBy('id', 'DESC')->paginate(20);

        return view('backend.blog.all', compact('blogs', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategory::all();

        return view('backend.blog.create', compact('categories'));
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

        $blog = new Blog();

        $new_id = $blog->create($request->all())->id;

        return redirect()->route('blog.index')->with(['success' => 'Ekleme işleminiz başarılı.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $blog = Blog::find($request->id);
        if ($blog) {
            $categories = BlogCategory::all();
            return view('backend.blog.edit', compact('blog', 'categories', 'request'));
        }

        return redirect()->route('blog.index')->withError('Blog bulunamadı!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $blog = Blog::find($request->id);

        if ($blog) {
            if ($request->hasFile('images')) {
                $image    = $request->file('images');
                $filename = 'blog-'.time() . '.' . $image->getClientOriginalExtension();
                $path     = public_path('upload/blog/' . $filename);
                Image::make($request->file('images')->getRealPath())->save($path);
                $request['image'] = $filename;
            }

            $blog->update($request->all());

            return redirect()->route('blog.index')->with(['success' => 'Güncelleme işleminiz başarılı.']);
        }

        return redirect()->route('blog.index')->withError('Blog bulunamadı!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $blog = Blog::find($request->id);
        if ($blog) {
            $blog->delete();

            return redirect()->route('blog.index')->with(['success' => 'Silme işleminiz başarılı.']);
        }

        return redirect()->route('blog.index')->withError('Blog bulunamadı!');
    }
}
