<?php

namespace App\Http\Controllers\Backend;

use App\Models\Reference;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $references = Reference::orderBy('id', 'DESC')->paginate(20);

        return view('backend.reference.all', compact('references', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.reference.create');
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
            $filename = 'reference-'.time() . '.' . $image->getClientOriginalExtension();
            $path     = public_path('upload/reference/' . $filename);
            Image::make($request->file('images')->getRealPath())->save($path);
            $request['image'] = $filename;
        }

        $reference = new Reference();

        $new_id = $reference->create($request->all())->id;

        return redirect()->route('reference.index')->with(['success' => 'Ekleme işleminiz başarılı.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $reference = Reference::find($request->id);

        if ($reference) {
            return view('backend.reference.edit', compact('reference', 'request'));
        }
        return redirect()->route('reference.index')->withError('Referans bulunamadı!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $reference = Reference::find($request->id);

        if ($reference) {
            if ($request->hasFile('images')) {
                $image    = $request->file('images');
                $filename = 'reference-'.time() . '.' . $image->getClientOriginalExtension();
                $path     = public_path('upload/reference/' . $filename);
                Image::make($request->file('images')->getRealPath())->save($path);
                $request['image'] = $filename;
            }

            $reference->update($request->all());

            return redirect()->route('reference.index')->with(['success' => 'Güncelleme işleminiz başarılı.']);
        }
        return redirect()->route('reference.index')->withError('Referans bulunamadı!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $reference = Reference::find($request->id);

        if ($reference) {
            $reference->delete();

            return redirect()->route('reference.index')->with(['success' => 'Silme işleminiz başarılı.']);
        }
        return redirect()->route('reference.index')->withError('Referans bulunamadı!');
    }
}
