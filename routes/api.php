<?php

use App\Models\DetailPengadaan;
use App\Models\DetailPenjualan;
use App\Models\Pengadaan;
use App\Models\Penjualan;
use App\Models\Supplier;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/tanaman', function() {
    $data = [
        'tanaman' => Tanaman::orderBy('nama')->get(),
    ];

    return $data;
});

Route::get('/supplier', function() {
    $data = [
        'supplier' => Supplier::orderBy('nama')->get(),
    ];

    return $data;
});

Route::post('/pengadaan', function(Request $req) {
    function get_kode_ada($last_id) {
        $default = 7;
        $length_id = strlen($last_id);
        $range = $default - $length_id;

        $data = '';
        for ($i=0; $i < $range; $i++) { 
            $data = $data . '0';
        }

        return 'KP' . $data . $last_id;
    }

    $last_id = Pengadaan::max('id');

    $pengadaan = [
        'user_id' => $req->user_id,
        'supplier_id' => $req->supplier_id,
        'tgl_pengadaan' => $req->tgl_pengadaan,
        'kode_pengadaan' => get_kode_ada($last_id + 1),
    ];

    $peng = Pengadaan::create($pengadaan);

    $total = 0;
    foreach ($req->detail as $d) {
        DetailPengadaan::create([
            'tanaman_id' => $d['tanaman_id'],
            'pengadaan_id' => $peng->id,
            'qty' => $d['qty'],
            'harga_beli' => $d['harga_beli'],
        ]);

        $total += $d['total'];

        $tanaman = Tanaman::find($d['tanaman_id']);

        if ($tanaman) {
            $stok = $tanaman->stok ?? 0;

            $sellStok = $d['qty'] ?? 0;
            $newStok = $stok + $sellStok;

            $tanaman->update(['stok' => $newStok]);
        }
    }

    $peng->update(['total' => $total]);

    return 'success';
});

Route::post('/penjualan', function(Request $req) {
    function get_kode_jual($last_id) {
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

    $penjualan = [
        'user_id' => $req->user_id,
        'tgl_penjualan' => $req->tgl_penjualan,
        'kode_penjualan' => get_kode_jual($last_id + 1),
        'nama' => $req->nama,
        'no_tlp' => $req->no_tlp,
    ];

    $pen = Penjualan::create($penjualan);

    $total = 0;
    foreach ($req->detail as $d) {
        DetailPenjualan::create([
            'tanaman_id' => $d['tanaman_id'],
            'penjualan_id' => $pen->id,
            'qty' => $d['qty'],
            'harga_jual' => $d['harga_jual'],
        ]);

        $total += $d['total'];

        $tanaman = Tanaman::find($d['tanaman_id']);

        if ($tanaman) {
            $stok = $tanaman->stok ?? 0;

            $sellStok = $d['qty'] ?? 0;
            $newStok = $stok - $sellStok;

            $tanaman->update(['stok' => $newStok]);
        }
    }

    $pen->update(['total' => $total]);

    return 'success';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
