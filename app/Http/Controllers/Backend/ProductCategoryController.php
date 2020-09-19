<?php

namespace App\Http\Controllers\Backend;

use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productcategories = ProductCategory::orderBy('id', 'DESC')->paginate(20);

        return view('backend.productcategory.all', compact('productcategories', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.productcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productcategory = new ProductCategory();

        if ($request->hasFile('images')) {
            $image    = $request->file('images');
            $filename = 'product-category-'.time() . '.' . $image->getClientOriginalExtension();
            $path     = public_path('upload/product/' . $filename);
            Image::make($request->file('images')->getRealPath())->save($path);
            $request['image'] = $filename;
        }

        $new_id = $productcategory->create($request->all())->id;

        return redirect()->route('product-category.index')->with(['success' => 'Ekleme işleminiz başarılı.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $productcategory = ProductCategory::find($request->id);
        if ($productcategory) {
            return view('backend.productcategory.edit', compact('productcategory', 'request'));
        }
        return redirect()->route('product-category.index')->withError('Kategori bulunamadı!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $productcategory = ProductCategory::find($request->id);

        if ($productcategory) {
            if ($request->hasFile('images')) {
                $image    = $request->file('images');
                $filename = 'product-category-'.time() . '.' . $image->getClientOriginalExtension();
                $path     = public_path('upload/product/' . $filename);
                Image::make($request->file('images')->getRealPath())->save($path);
                $request['image'] = $filename;
            }

            $productcategory->update($request->all());

            return redirect()->route('product-category.index')->with(['success' => 'Güncelleme işleminiz başarılı.']);
        }
        return redirect()->route('product-category.index')->withError('Kategori bulunamadı!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $productcategory = ProductCategory::find($request->id);

        if ($productcategory) {
            $productcategory->delete();

            return redirect()->route('product-category.index')->with(['success' => 'Silme işleminiz başarılı.']);
        }
        return redirect()->route('product-category.index')->withError('Kategori bulunamadı!');
    }
}
