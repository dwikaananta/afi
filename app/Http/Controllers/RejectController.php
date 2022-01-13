<?php

namespace App\Http\Controllers;

use App\Models\Reject;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class RejectController extends Controller
{
    public function index()
    {
        $reject = Reject::with('tanaman')->get();

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
        ]);

        $tanaman = Tanaman::find($req->tanaman_id);

        $data = [
            'tanaman_id' => $req->tanaman_id,
            'qty' => $req->qty,
            'total' => $tanaman->harga_jual * $req->qty,
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
        ]);

        $tanaman = Tanaman::find($req->tanaman_id);

        $data = [
            'tanaman_id' => $req->tanaman_id,
            'qty' => $req->qty,
            'total' => $tanaman->harga_jual * $req->qty,
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
