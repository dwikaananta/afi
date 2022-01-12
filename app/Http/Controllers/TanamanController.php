<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use Illuminate\Http\Request;

class TanamanController extends Controller
{
    public function index()
    {
        $tanaman = Tanaman::get();

        return view('tanaman.tanaman', [
            'title' => 'Data Tanaman',
            'tanaman' => $tanaman,
        ]);
    }

    public function create()
    {
        return view('tanaman.create', [
            'title' => 'Tambah Tanaman',
        ]);
    }

    public function store(Request $req)
    {
        $req->validate([
            'kategori' => 'required',
            'nama' => 'required',
            'img' => 'required|mimes:jpg,jpeg,png|max:5000',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);

        function handleUpload($req) {
            if ($req->file('img')) {
                $id = Tanaman::max('id');
                $img_name = $id + 1 . '.' . $req->img->extension();

                if ($img_name) {
                    $moved = $req->img->storeAs('/public/tanaman', $img_name);

                    if ($moved) {
                        return $img_name;
                    }
                }
            }

            return null;
        }

        $data = [
            'kategori' => $req->kategori,
            'nama' => $req->nama,
            'img' => handleUpload($req),
            'harga_beli' => $req->harga_beli,
            'harga_jual' => $req->harga_jual,
            'stok' => $req->stok,
        ];

        Tanaman::create($data);

        return redirect('/tanaman')->with('success', 'Berhasil tambah Data Tanaman !');
    }

    public function show(Tanaman $tanaman)
    {
        //
    }

    public function edit(Tanaman $tanaman)
    {
        return view('tanaman.edit', [
            'title' => 'Ubah Tanaman',
            'tanaman' => $tanaman,
        ]);
    }

    public function update(Request $req, Tanaman $tanaman)
    {
        $req->validate([
            'kategori' => 'required',
            'nama' => 'required',
            'img' => 'mimes:jpg,jpeg,png|max:5000',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);

        function handleUpdate($tanaman, $req) {
            if ($req->file('img')) {
                $req->img->storeAs('/public/tanaman', $tanaman->img);
            }

            return $tanaman->img;
        }

        $data = [
            'kategori' => $req->kategori,
            'nama' => $req->nama,
            'img' => handleUpdate($tanaman, $req),
            'harga_beli' => $req->harga_beli,
            'harga_jual' => $req->harga_jual,
            'stok' => $req->stok,
        ];

        $tanaman->update($data);

        return redirect('/tanaman')->with('success', 'Berhasil ubah Data Tanaman !');
    }

    public function destroy(Tanaman $tanaman, Request $req)
    {
        // 9 tidak aktif && null aktif

        $tanaman->update(['status' => $req->actived ? null : 9]);

        return back()->with('success', 'Berhasil update status Tanaman !');
    }
}
