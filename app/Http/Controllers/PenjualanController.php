<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('penjualan.penjualan', [
            'title' => 'Data Penjualan',
            'penjualan' => Penjualan::get(),
            'user' => User::orderBy('nama', 'asc')->get()->toArray(),
        ]);
    }

    public function create()
    {
        return view('penjualan.create', [
            'title' => 'Tambah Penjualan',
        ]);
    }

    public function store(Request $req)
    {
        $req->validate([
            'tgl_penjualan' => 'required',
            'nama' => 'required',
            'no_tlp' => 'required',
            'total' => 'required',
        ]);

        function get_kode($last_id) {
            $default = 7;
            $length_id = strlen($last_id);
            $range = $default - $length_id;

            $data = '';
            for ($i=0; $i < $range; $i++) { 
                $data = $data . '0';
            }

            return 'KJ' . $data . $last_id;
        }

        $last_id = Penjualan::max('id');

        $data = [
            'user_id' => $req->user()->id,
            'tgl_penjualan' => $req->tgl_penjualan,
            'kode_penjualan' => get_kode($last_id),
            'nama' => $req->nama,
            'no_tlp' => $req->no_tlp,
            'total' => $req->total,
        ];

        Penjualan::create($data);

        return redirect('/penjualan')->with('success', 'Berhasil tambah Data Penjualan !');
    }

    public function show(Penjualan $penjualan)
    {
        return view('penjualan.show', [
            'title' => 'Detail Penjualan',
            'penjualan' => $penjualan,
        ]);
    }

    public function edit(Penjualan $penjualan)
    {
        return view('penjualan.edit', [
            'title' => 'Ubah Penjualan',
            'penjualan' => $penjualan,
        ]);
    }

    public function update(Request $req, Penjualan $penjualan)
    {
        $data = $req->validate([
            'tgl_penjualan' => 'required',
            'nama' => 'required',
            'no_tlp' => 'required',
            'total' => 'required',
        ]);

        $penjualan->update($data);

        return redirect('/penjualan')->with('success', 'Berhasil ubah Data Penjualan !');
    }

    public function destroy(Penjualan $penjualan, Request $req)
    {
        // 9 tidak aktif && null aktif

        $penjualan->update(['status' => $req->actived ? null : 9]);

        if ($req->actived) {
            // aktifkan
            $detail_pengadaan = DetailPenjualan::with('tanaman')->where('penjualan_id', $penjualan->id)->get();

            foreach ($detail_pengadaan as $dp) {
                $dp->tanaman()->update(['stok' => $dp->tanaman->stok - $dp->qty]);
            }
        } else {
            // nonaktifkan
            $detail_pengadaan = DetailPenjualan::with('tanaman')->where('penjualan_id', $penjualan->id)->get();

            foreach ($detail_pengadaan as $dp) {
                $dp->tanaman()->update(['stok' => $dp->tanaman->stok + $dp->qty]);
            }
        }

        return back()->with('success', 'Berhasil update status Penjualan !');
    }
}
