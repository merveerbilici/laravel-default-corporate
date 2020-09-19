<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;

use Session;
use Validator;

class AuthController extends Controller
{
    public function getLogin()
    {
        if (Auth::check()) {
            return redirect()->route('get.index.admin');
        }
        return view('backend.auth.login');
    }
    public function postLogin(Request $request)
    {
        $rules = [
            'email' => 'required|exists:users',
            'password' => 'required',
        ];
        $messages = [
            'password.required' => 'Şifre zorunludur.',
            'email.required' => 'Email zorunludur.',
            'email.exists' => 'Bu email kayıtlı değil.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
 
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('get.index.admin');
        }
        return redirect()->route('get.login')->withError('Şifre yanlış!');
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('get.login');
    }
}