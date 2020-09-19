<?php

namespace App\Http\Controllers\Backend;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = Service::orderBy('id', 'DESC')->paginate(20);

        return view('backend.service.all', compact('services', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.service.create');
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
            $filename = 'service-'.time() . '.' . $image->getClientOriginalExtension();
            $path     = public_path('upload/service/' . $filename);
            Image::make($request->file('images')->getRealPath())->save($path);
            $request['image'] = $filename;
        }

        $service = new Service();

        $new_id = $service->create($request->all())->id;

        return redirect()->route('service.index')->with(['success' => 'Ekleme işleminiz başarılı.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $service = Service::find($request->id);

        if ($service) {
            return view('backend.service.edit', compact('service', 'request'));
        }
        return redirect()->route('service.index')->withError('Hizmet bulunamadı!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $service = Service::find($request->id);

        if ($service) {
            if ($request->hasFile('images')) {
                $image    = $request->file('images');
                $filename = 'service-'.time() . '.' . $image->getClientOriginalExtension();
                $path     = public_path('upload/service/' . $filename);
                Image::make($request->file('images')->getRealPath())->save($path);
                $request['image'] = $filename;
            }

            $service->update($request->all());

            return redirect()->route('service.index')->with(['success' => 'Güncelleme işleminiz başarılı.']);
        }
        return redirect()->route('service.index')->withError('Hizmet bulunamadı!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $service = Service::find($request->id);

        if ($service) {
            $service->delete();

            return redirect()->route('service.index')->with(['success' => 'Silme işleminiz başarılı.']);
        }
        return redirect()->route('service.index')->withError('Hizmet bulunamadı!');
    }
}
