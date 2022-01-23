<?php

namespace App\Http\Controllers;

use App\Models\Reject;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class RejectController extends Controller
{
    public function index(Request $req)
    {
        $reject = Reject::with('tanaman')
            ->when($req->bulan, fn($query) => $query->whereMonth('tgl_reject', $req->bulan))
            ->when($req->tahun, fn($query) => $query->whereYear('tgl_reject', $req->tahun))
            ->get();

        return view('reject.reject', [
            'title' => 'Data Reject',
            'reject' => $reject,
        ]);
    }

    public function create()
    {
        return view('reject.create', [
            'title' => 'Tambah Reject',
            'tanaman' => Tanaman::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $req)
    {
        $req->validate([
            'tanaman_id' => 'required',
            'qty' => 'required',
            'tgl_reject' => 'required',
        ]);

        $tanaman = Tanaman::find($req->tanaman_id);

        $data = [
            'tanaman_id' => $req->tanaman_id,
            'qty' => $req->qty,
            'total' => $tanaman->harga_beli * $req->qty,
            'tgl_reject' => $req->tgl_reject,
        ];

        Reject::create($data);

        return redirect('/reject')->with('success', 'Berhasil tambah Data Reject !');
    }

    public function show(Reject $reject)
    {
        //
    }

    public function edit(Reject $reject)
    {
        return view('reject.edit', [
            'title' => 'Ubah Reject',
            'reject' => $reject,
            'tanaman' => Tanaman::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $req, Reject $reject)
    {
        $req->validate([
            'tanaman_id' => 'required',
            'qty' => 'required',
            'tgl_reject' => 'required',
        ]);

        $tanaman = Tanaman::find($req->tanaman_id);

        $data = [
            'tanaman_id' => $req->tanaman_id,
            'qty' => $req->qty,
            'total' => $tanaman->harga_jual * $req->qty,
            'tgl_reject' => $req->tgl_reject,
        ];

        $reject->update($data);

        return redirect('/reject')->with('success', 'Berhasil ubah Data Reject !');
    }

    public function destroy(Reject $reject, Request $req)
    {
        // 9 tidak aktif && null aktif

        $reject->update(['status' => $req->actived ? null : 9]);

        return back()->with('success', 'Berhasil update status Reject !');
    }
}
