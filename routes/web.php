<?php

use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\RejectController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TanamanController;
use App\Http\Controllers\UserController;
use App\Models\DetailPenjualan;
use App\Models\Pengadaan;
use App\Models\Penjualan;
use App\Models\Reject;
use App\Models\Tanaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    $user = User::count();

    if ($user == 0) {
        User::create([
            'nama' => 'Owner',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Admin123'),
            'level' => 9,
        ]);
    }

    return view('login');
});

Route::post('/auth', function(Request $req) {
    $credentials = $req->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $req->session()->regenerate();

        return redirect()->intended('/dashboard?tahun=' . date('Y'))->with('success', 'Login sukses');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

Route::middleware('is_login')->group(function() {

    Route::get('/dashboard', function(Request $req) {

        return view('dashboard', [
            'title' => 'Dashboard',
            'total_tanaman' => Tanaman::count(),
            'total_penjualan' => Penjualan::count(),
            'total_pengadaan' => Pengadaan::count(),
            'total_reject' => Reject::count(),
            'Pendapat_Januari' => Penjualan::whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 1)->count(),
            'Pengeluaran_Januari' => Pengadaan::whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 1)->count(),
            'Pendapat_Februari' => Penjualan::whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 2)->count(),
            'Pengeluaran_Februari' => Pengadaan::whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 2)->count(),
            'Pendapat_Maret' => Penjualan::whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 3)->count(),
            'Pengeluaran_Maret' => Pengadaan::whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 3)->count(),
            'Pendapat_April' => Penjualan::whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 4)->count(),
            'Pengeluaran_April' => Pengadaan::whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 4)->count(),
            'Pendapat_Mai' => Penjualan::whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 5)->count(),
            'Pengeluaran_Mai' => Pengadaan::whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 5)->count(),
            'Pendapat_Juni' => Penjualan::whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 6)->count(),
            'Pengeluaran_Juni' => Pengadaan::whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 6)->count(),
            'Pendapat_Juli' => Penjualan::whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 7)->count(),
            'Pengeluaran_Juli' => Pengadaan::whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 7)->count(),
            'Pendapat_Agustus' => Penjualan::whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 9)->count(),
            'Pengeluaran_Agustus' => Pengadaan::whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 9)->count(),
            'Pendapat_September' => Penjualan::whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 9)->count(),
            'Pengeluaran_September' => Pengadaan::whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 9)->count(),
            'Pendapat_Oktober' => Penjualan::whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 10)->count(),
            'Pengeluaran_Oktober' => Pengadaan::whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 10)->count(),
            'Pendapat_November' => Penjualan::whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 11)->count(),
            'Pengeluaran_November' => Pengadaan::whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 11)->count(),
            'Pendapat_Desember' => Penjualan::whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 12)->count(),
            'Pengeluaran_Desember' => Pengadaan::whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 12)->count(),

            'pie_2' => DetailPenjualan::whereHas('tanaman', function($query) {
                return $query->where('kategori', 2);
            })->whereHas('penjualan', function($query) {
                return $query->whereYear('tgl_penjualan', $_GET['tahun']);
            })->count(),
            'pie_3' => DetailPenjualan::whereHas('tanaman', function($query) {
                return $query->where('kategori', 3);
            })->whereHas('penjualan', function($query) {
                return $query->whereYear('tgl_penjualan', $_GET['tahun']);
            })->count(),
            'pie_4' => DetailPenjualan::whereHas('tanaman', function($query) {
                return $query->where('kategori', 4);
            })->whereHas('penjualan', function($query) {
                return $query->whereYear('tgl_penjualan', $_GET['tahun']);
            })->count(),
            'pie_5' => DetailPenjualan::whereHas('tanaman', function($query) {
                return $query->where('kategori', 5);
            })->whereHas('penjualan', function($query) {
                return $query->whereYear('tgl_penjualan', $_GET['tahun']);
            })->count(),
            'pie_6' => DetailPenjualan::whereHas('tanaman', function($query) {
                return $query->where('kategori', 6);
            })->whereHas('penjualan', function($query) {
                return $query->whereYear('tgl_penjualan', $_GET['tahun']);
            })->count(),
            'pie_7' => DetailPenjualan::whereHas('tanaman', function($query) {
                return $query->where('kategori', 7);
            })->whereHas('penjualan', function($query) {
                return $query->whereYear('tgl_penjualan', $_GET['tahun']);
            })->count(),
        ]);
    });

    Route::resource('/user', UserController::class);
    Route::resource('/tanaman', TanamanController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/pengadaan', PengadaanController::class);
    Route::resource('/penjualan', PenjualanController::class);
    Route::resource('/reject', RejectController::class);

    Route::get('/laporan-pengadaan', function(Request $req) {
        $pengadaan = Pengadaan::get();
        return view('laporan.pengadaan', [
            'title' => 'Laporan Pengadaan',
            'pengadaan' => $pengadaan,
        ]);
    });

    Route::get('/pengadaan-detail/{id}', function($id, Request $req) {
        $pengadaan = Pengadaan::with('detail_pengadaan')->find($id);
        return view('laporan.pengadaan-detail', [
            'pengadaan' => $pengadaan,
        ]);
    });

    Route::get('/laporan-penjualan', function(Request $req) {
        $penjualan = Penjualan::with('user')->get();
        return view('laporan.penjualan', [
            'title' => 'Laporan Penjualan',
            'penjualan' => $penjualan,
        ]);
    });

    Route::get('/penjualan-detail/{id}', function($id, Request $req) {
        $penjualan = Penjualan::with('detail_penjualan')->find($id);
        return view('laporan.penjualan-detail', [
            'penjualan' => $penjualan,
        ]);
    });

    Route::get('/logout', function(Request $req) {
        Auth::logout();

        $req->session()->invalidate();
    
        $req->session()->regenerateToken();
    
        return redirect('/')->with('success', 'Login sukses !');
    });

});