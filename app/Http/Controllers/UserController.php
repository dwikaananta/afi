<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth_owner');
        $this->middleware('auth_admin')->only(['show', 'update']);
    }

    public function index()
    {
        return view('user.user', [
            'title' => 'Data User',
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'img' => 'required|mimes:jpg,jpeg,png|max:5000',
            'nama' => 'required',
            'gender' => 'required',
            'no_tlp' => 'required|max:20',
            'email' => 'required|max:150',
            'alamat' => 'required',
            'regdate' => 'required',
            'password' => 'required',
            'password' => 'required|confirmed',
        ]);

        // function getImgName() {
        //     $name_file = 
        //     return
        // }

        // $data = [
        //     'img' => ,
        //     'nama',
        //     'gender',
        //     'no_tlp',
        //     'email',
        //     'alamat',
        //     'regdate',
        //     'password',
        //     'level',
        //     'status',
        // ];
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        User::find($id)->update(['status' => 9]);

        return redirect('/user')->with('success', 'Berhasil hapus user !');
    }
}
