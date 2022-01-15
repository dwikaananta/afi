<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::orderBy('nama')->get();

        return view('supplier.supplier', [
            'title' => 'Data Supplier',
            'supplier' => $supplier,
        ]);
    }

    public function create()
    {
        return view('supplier.create', [
            'title' => 'Tambah Supplier',
        ]);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'nama' => 'required',
            'email' => 'required|unique:supplier,email',
            'no_tlp' => 'required',
            'alamat' => 'required',
        ]);

        Supplier::create($data);

        return redirect('/supplier')->with('success', 'Berhasil tambah Data Supplier !');
    }

    public function show(Supplier $supplier)
    {
        //
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', [
            'title' => 'Ubah Supplier',
            'supplier' => $supplier,
        ]);
    }

    public function update(Request $req, Supplier $supplier)
    {
        function valEmail($supplier, $req) {
            if ($supplier->email == $req->email) {
                return 'required';
            } else {
                return 'required|max:150|unique:supplier,email';
            }
        }

        $data = $req->validate([
            'nama' => 'required',
            'email' => valEmail($supplier, $req),
            'no_tlp' => 'required',
            'alamat' => 'required',
        ]);

        $supplier->update($data);

        return redirect('/supplier')->with('success', 'Berhasil ubah Data Supplier !');
    }

    public function destroy(Supplier $supplier, Request $req)
    {
        // 9 tidak aktif && null aktif

        $supplier->update(['status' => $req->actived ? null : 9]);

        return back()->with('success', 'Berhasil update status Supplier !');
    }
}
