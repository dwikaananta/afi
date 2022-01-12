<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::whereNull('level')->get();

        return view('user.user', [
            'title' => 'Data User',
            'user' => $user,
        ]);
    }

    public function create()
    {
        return view('user.create', [
            'title' => 'Tambah User',
        ]);
    }

    public function store(Request $req)
    {
        $req->validate([
            'img' => 'required|mimes:jpg,jpeg,png|max:5000',
            'nama' => 'required',
            'gender' => 'required',
            'no_tlp' => 'required|max:20',
            'email' => 'required|max:150|unique:users,email',
            'alamat' => 'required',
            'password' => 'required|confirmed',
        ]);

        function handleUpload($req) {
            if ($req->file('img')) {
                $id = User::max('id');
                $img_name = $id + 1 . '.' . $req->img->extension();

                if ($img_name) {
                    $moved = $req->img->storeAs('/public/users', $img_name);

                    if ($moved) {
                        return $img_name;
                    }
                }
            }

            return null;
        }

        $data = [
            'img' => handleUpload($req),
            'nama' => $req->nama,
            'gender' => $req->gender,
            'no_tlp' => $req->no_tlp,
            'email' => $req->email,
            'alamat' => $req->alamat,
            'regdate' => date(now()),
            'password' => Hash::make($req->password),
            'level' => null,
            'status' => null,
        ];

        User::create($data);

        return redirect('/user')->with('success', 'Berhasil tambah Data User !');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', [
            'title' => 'Ubah User',
            'user' => $user,
        ]);
    }

    public function update(Request $req, $id)
    {
        $user = User::find($id);

        function valEmail($user, $req) {
            if ($user->email == $req->email) {
                return 'required';
            } else {
                return 'required|max:150|unique:users,email';
            }
        }

        $req->validate([
            'img' => 'mimes:jpg,jpeg,png|max:5000',
            'nama' => 'required',
            'gender' => 'required',
            'no_tlp' => 'required|max:20',
            'email' => valEmail($user, $req),
            'alamat' => 'required',
            'password' => 'confirmed',
        ]);

        function handleUpdate($user, $req) {
            if ($req->file('img')) {
                $req->img->storeAs('/public/users', $user->img);
            }

            return $user->img;
        }

        if ($req->password) {
            $user->update(['password' => Hash::make($req->password)]);
        }

        $data = [
            'img' => handleUpdate($user, $req),
            'nama' => $req->nama,
            'gender' => $req->gender,
            'no_tlp' => $req->no_tlp,
            'email' => $req->email,
            'alamat' => $req->alamat,
            'regdate' => date(now()),
            'level' => $user->level,
            'status' => $user->status,
        ];

        $user->update($data);

        return redirect('/user')->with('success', 'Berhasil ubah Data User !');
    }

    public function destroy($id, Request $req)
    {
        // 9 tidak aktif && null aktif

        User::find($id)->update(['status' => $req->actived ? null : 9]);

        return back()->with('success', 'Berhasil update status User !');
    }
}
