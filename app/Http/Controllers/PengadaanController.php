<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use App\Models\Supplier;
use App\Models\Tanaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengadaanController extends Controller
{
    public function index()
    {
        return view('pengadaan.pengadaan', [
            'title' => 'Data Pengadaan',
            'pengadaan' => Pengadaan::with('user', 'supplier')->get(),
        ]);
    }

    public function create()
    {
        return view('pengadaan.create', [
            'title' => 'Tambah Pengadaan',
            'supplier' => Supplier::orderBy('nama', 'asc')->get(),
            'tanaman' => Tanaman::orderBy('nama', 'asc')->get(),
        ]);
    }

    public function store(Request $req)
    {
        $req->validate([
            'supplier_id' => 'required',
            'tgl_pengadaan' => 'required',
            'total' => 'required',
        ]);

        function get_kode($last_id)
        {
            $default = 7;
            $length_id = strlen($last_id);
            $range = $default - $length_id;

            $data = '';
            for ($i = 0; $i < $range; $i++) {
                $data = $data . '0';
            }

            return 'KP' . $data . $last_id;
        }

        $last_id = Pengadaan::max('id');

        $data = [
            'user_id' => $req->user()->id,
            'supplier_id' => $req->supplier_id,
            'tgl_pengadaan' => $req->tgl_pengadaan,
            'kode_pengadaan' => get_kode($last_id + 1),
            'total' => $req->total,
        ];

        Pengadaan::create($data);

        return redirect('/pengadaan')->with('success', 'Berhasil tambah Data Pengadaan !');
    }

    public function show(Pengadaan $pengadaan)
    {
        return view('pengadaan.show', [
            'title' => 'Detail Pengadaan',
            'pengadaan' => $pengadaan,
        ]);
    }

    public function edit(Pengadaan $pengadaan)
    {
        return view('pengadaan.edit', [
            'title' => 'Ubah Pengadaan',
            'pengadaan' => $pengadaan,
            'supplier' => Supplier::orderBy('nama', 'asc')->get(),
        ]);
    }

    public function update(Request $req, Pengadaan $pengadaan)
    {
        $data = $req->validate([
            'supplier_id' => 'required',
            'tgl_pengadaan' => 'required',
            'total' => 'required',
        ]);

        $pengadaan->update($data);

        return redirect('/pengadaan')->with('success', 'Berhasil ubah Data Pengadaan !');
    }

    public function destroy(Pengadaan $pengadaan, Request $req)
    {
        // 9 tidak aktif && null aktif

        $pengadaan->update(['status' => $req->actived ? null : 9]);

        return back()->with('success', 'Berhasil update status Pengadaan !');
    }
}
