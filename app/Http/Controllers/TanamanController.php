<?php

namespace App\Http\Controllers;

use App\Models\LogHarga;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class TanamanController extends Controller
{
    public function index()
    {
        // $non_kode = Tanaman::whereNull('kode')->get();
        // if ($non_kode) {
        //     foreach ($non_kode as $nk) {
        //         $nk->update([
        //             'kode' => $this->getKodeTanaman($nk->id),
        //         ]);
        //     }
        // }

        $tanaman = Tanaman::with('log_harga')->orderBy('kategori')->orderBy('nama')->get();

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
            'nama_latin' => 'required',
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

        $last_id = Tanaman::max('id');

        $data = [
            'kategori' => $req->kategori,
            // 'kode' => $this->getKodeTanaman($last_id + 1),
            'nama' => $req->nama_latin . '||' . $req->nama,
            'img' => handleUpload($req),
            'harga_beli' => $req->harga_beli,
            'harga_jual' => $req->harga_jual,
            'stok' => $req->stok,
        ];

        $tanaman = Tanaman::create($data);

        // getKodeLog
        function getKodeLogHarga($last_id) {
            $default = 6;
            $length_id = strlen($last_id);
            $range = $default - $length_id;

            $data = '';
            for ($i=0; $i < $range; $i++) { 
                $data = $data . '0';
            }

            return 'KL' . $data . $last_id;
        }

        $last_id_log = LogHarga::max('id');

        LogHarga::create([
            // 'kode' => getKodeLogHarga($last_id_log + 1),
            'tanaman_id' => $tanaman->id,
            'harga_beli' => $req->harga_beli,
        ]);

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
            'nama_latin' => 'required',
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
            'nama' => $req->nama_latin . '||' . $req->nama,
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

    function getKodeTanaman($last_id) {
        $default = 6;
        $length_id = strlen($last_id);
        $range = $default - $length_id;

        $data = '';
        for ($i=0; $i < $range; $i++) { 
            $data = $data . '0';
        }

        return 'KT' . $data . $last_id;
    }
}
