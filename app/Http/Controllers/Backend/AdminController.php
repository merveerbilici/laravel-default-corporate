<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Setting;

class AdminController extends Controller
{    
    public function getIndex(Request $request)
    {
        return view('backend.index');
    }
    public function getSettings()
    {
        return view('backend.settings.all');
    }
    public function postSettings(Request $request)
    {
        foreach ($request->except('_token') as $key => $value)
        {
            Setting::set($key, $value);
        }
        Setting::save();

        return redirect()->back()->withSuccess('Başarılı');
    }
}