<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->paginate(20);

        return view('backend.user.all', compact('users', 'request'));
    }
    public function create(Request $request)
    {
        return view('backend.user.create');
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
        ];
        $messages = [
            'name.required' => 'Ad Soyad zorunludur.',
            'name.max' => 'Ad Soyad max 255 karakter olmalıdır.',
            'email.required' => 'Email zorunludur.',
            'email.max' => 'Email max 255 karakter olmalıdır.',
            'email.unique' => 'Bu email kayıtlıdır.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $request['profile_photo'] = 'default.png';
        if ($request->hasFile('profile_photos')) {
            $image    = $request->file('profile_photos');
            $filename = 'user-'.time() . '.' . $image->getClientOriginalExtension();
            $path     = public_path('upload/user/' . $filename);
            Image::make($request->file('profile_photos')->getRealPath())->save($path);
            $request['profile_photo'] = $filename;
        }
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'profile_photo' => $request['profile_photo']
        ]);

        return redirect()->route('user.index')->with(['success' => 'Ekleme işleminiz başarılı.']);
    }
    public function edit(Request $request)
    {
        $user = User::find($request->id);

        if ($user) {
            return view('backend.user.edit', compact('user', 'request'));
        }
        return redirect()->route('user.index')->withError('Kullanıcı bulunamadı!');
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);

        if ($user) {
            if ($request->hasFile('profile_photos')) {
                $image    = $request->file('profile_photos');
                $filename = 'user-'.time() . '.' . $image->getClientOriginalExtension();
                $path     = public_path('upload/user/' . $filename);
                Image::make($request->file('profile_photos')->getRealPath())->save($path);
                $request['profile_photo'] = $filename;
            }
        
            if ($request->password == null) {
                $user->update($request->except('password'));
            } else {
                $request['password'] = Hash::make($request['password']);
                $user->update($request->all());
            }

            return redirect()->route('user.index')->with(['success' => 'Güncelleme işleminiz başarılı.']);
        }
        return redirect()->route('user.index')->withError('Kullanıcı bulunamadı!');
    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);

        if ($user) {
            $user->delete();

            return redirect()->route('user.index')->with(['success' => 'Silme işleminiz başarılı.']);
        }
        return redirect()->route('user.index')->withError('Kullanıcı bulunamadı!');
    }
}