<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.user.index');
    }

    public function add()
    {
        return view('backend.user.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'            => 'required|string|min:2|max:255',//['required', 'string', 'max:255'],
            'last_name'             => 'required|string|min:2|max:255',
            'phone'                 => 'required|string|min:2|max:255',
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required'
        ]);


        $user = new User();
        $user->password = Hash::make($request->get('password'));
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');

        if ($request->hasFile('photo_path')) {
            $this->validate(request(), ['photo_path' => 'image|mimes:png,jpg,jpeg,gif']);
            $path = Storage::disk('local')->put('/public/backend/images', request()->file('photo_path'));
            $user->image = $path;
        }
        $user->save();

        if ($user) {
            toastr()->success('İşlem Tamamlandı.');
            return redirect()->route('users.detail',['id'=>$user->id]);
        } else {
            toastr()->error('İşlem Yapılırken Bir Sorun Oluştut.');
            return back();
        }
    }

    public function edit($id)
    {
        $uc = User::where('id', $id)->count();
        if ($uc != 0) {
            $userInfo = User::where('id', $id)->first();
            return view('backend.user.edit', ['userInfo' => $userInfo]);
        } else {
            abort(404);
        }
    }

    public function detail($id)
    {
        $userCount = User::where('id', $id)->count();
        if ($userCount != 0) {
            $userInfo = User::where('id', $id)->first();
            return view('backend.user.detail', ['userInfo' => $userInfo]);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'first_name'            => 'required|string|min:2|max:255',
            'last_name'             => ['required', 'string', 'max:255'],
            'phone'                 => ['required', 'string', 'max:255'],
            'email'                 => 'required|email|unique:users,email,' . $id,
            'password'              => ['nullable', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'nullable'
        ]);

        $user = User::findOrFail($id);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        $user->status = $request->get('status');

        if ($request->hasFile('photo_path')) {
            $this->validate(request(), ['photo_path' => 'image|mimes:png,jpg,jpeg,gif']);
            $path = Storage::disk('local')->put('/public/backend/images', request()->file('photo_path'));
            $user->image = $path;
        }

        if($request->old_password){
            if ($user->password == Hash::make($request->old_password)) {
                $user->password = Hash::make($request->password);
            } else {
                toastr()->error('Mevcut Parolanız yanlıştır.');
                return back();
            }
        }

        $user->save();

        if ($user) {
            toastr()->success('İşlem Başarılı.');
            return back();
        } else {
            toastr()->error('İşlem Yapılırken Bir Sorun Oluştut.');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = User::destroy($id);
        if($destroy){
            toastr()->success('Silme İşlemi Başarıyla Gerçekleşti!');
            return redirect()->route('users.list');
        }else{
            toastr()->error('Silme İşlemi Yapılırken Bir Sorun Oluştu!');
            return back();
        }
    }
}
