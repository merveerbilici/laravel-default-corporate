<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('id', 'DESC')->paginate(20);

        return view('backend.product.all', compact('products', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();

        return view('backend.product.create', compact('categories'));
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
            $filename = 'product-'.time() . '.' . $image->getClientOriginalExtension();
            $path     = public_path('upload/product/' . $filename);
            Image::make($request->file('images')->getRealPath())->save($path);
            $request['image'] = $filename;
        }

        $product = new Product();

        $new_id = $product->create($request->all())->id;

        return redirect()->route('product.index')->with(['success' => 'Ekleme işleminiz başarılı.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $product = Product::find($request->id);
        if ($product) {
            $categories = ProductCategory::all();
            return view('backend.product.edit', compact('product', 'categories', 'request'));
        }
        return redirect()->route('product.index')->withError('Ürün bulunamadı!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product = Product::find($request->id);

        if ($product) {
            if ($request->hasFile('images')) {
                $image    = $request->file('images');
                $filename = 'product-'.time() . '.' . $image->getClientOriginalExtension();
                $path     = public_path('upload/product/' . $filename);
                Image::make($request->file('images')->getRealPath())->save($path);
                $request['image'] = $filename;
            }

            $product->update($request->all());

            return redirect()->route('product.index')->with(['success' => 'Güncelleme işleminiz başarılı.']);
        }
        return redirect()->route('product.index')->withError('Ürün bulunamadı!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->id);

        if ($product) {
            $product->delete();

            return redirect()->route('get.product.all')->with(['success' => 'Silme işleminiz başarılı.']);
        }
        return redirect()->route('product.index')->withError('Ürün bulunamadı!');
    }
}
