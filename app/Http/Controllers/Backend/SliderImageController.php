<?php

namespace App\Http\Controllers\Backend;

use App\Models\SliderImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;

class SliderImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sliderimages = SliderImage::orderBy('id', 'DESC')->paginate(20);

        return view('backend.sliderimage.all', compact('sliderimages', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sliderimage.create');
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
            $filename = 'slider-'.time() . '.' . $image->getClientOriginalExtension();
            $path     = public_path('upload/slider/' . $filename);
            Image::make($request->file('images')->getRealPath())->save($path);
            $request['image'] = $filename;
        }

        $sliderimage = new SliderImage();

        $new_id = $sliderimage->create($request->all())->id;

        return redirect()->route('slider-image.index')->with(['success' => 'Ekleme işleminiz başarılı.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $sliderimage = SliderImage::find($request->id);

        if ($sliderimage) {
            return view('backend.sliderimage.edit', compact('sliderimage', 'request'));
        }
        return redirect()->route('sliderimage.index')->withError('Görsel bulunamadı!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $sliderimage = SliderImage::find($request->id);

        if ($sliderimage) {
            if ($request->hasFile('images')) {
                $image    = $request->file('images');
                $filename = 'slider-'.time() . '.' . $image->getClientOriginalExtension();
                $path     = public_path('upload/slider/' . $filename);
                Image::make($request->file('images')->getRealPath())->save($path);
                $request['image'] = $filename;
            }

            $sliderimage->update($request->all());

            return redirect()->route('slider-image.index')->with(['success' => 'Güncelleme işleminiz başarılı.']);
        }
        return redirect()->route('sliderimage.index')->withError('Görsel bulunamadı!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sliderimage = SliderImage::find($request->id);

        if ($sliderimage) {
            $sliderimage->delete();

            return redirect()->route('slider-image.index')->with(['success' => 'Silme işleminiz başarılı.']);
        }
        return redirect()->route('sliderimage.index')->withError('Görsel bulunamadı!');
    }
}
