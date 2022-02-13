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
use Illuminate\Support\Facades\DB;
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
            'total_tanaman' => Tanaman::sum('stok'),
            'total_penjualan' => DB::table('count_penjualan')->sum('total_qty'),
            'total_pengadaan' => DB::table('count_pengadaan')->sum('total_qty'),
            'total_reject' => Reject::sum('qty'),
            'Pendapat_Januari' => DB::table('count_penjualan')->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 1)->sum('total_qty'),
            'Pengeluaran_Januari' => DB::table('count_pengadaan')->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 1)->sum('total_qty'),
            'Pendapat_Februari' => DB::table('count_penjualan')->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 2)->sum('total_qty'),
            'Pengeluaran_Februari' => DB::table('count_pengadaan')->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 2)->sum('total_qty'),
            'Pendapat_Maret' => DB::table('count_penjualan')->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 3)->sum('total_qty'),
            'Pengeluaran_Maret' => DB::table('count_pengadaan')->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 3)->sum('total_qty'),
            'Pendapat_April' => DB::table('count_penjualan')->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 4)->sum('total_qty'),
            'Pengeluaran_April' => DB::table('count_pengadaan')->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 4)->sum('total_qty'),
            'Pendapat_Mai' => DB::table('count_penjualan')->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 5)->sum('total_qty'),
            'Pengeluaran_Mai' => DB::table('count_pengadaan')->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 5)->sum('total_qty'),
            'Pendapat_Juni' => DB::table('count_penjualan')->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 6)->sum('total_qty'),
            'Pengeluaran_Juni' => DB::table('count_pengadaan')->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 6)->sum('total_qty'),
            'Pendapat_Juli' => DB::table('count_penjualan')->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 7)->sum('total_qty'),
            'Pengeluaran_Juli' => DB::table('count_pengadaan')->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 7)->sum('total_qty'),
            'Pendapat_Agustus' => DB::table('count_penjualan')->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 9)->sum('total_qty'),
            'Pengeluaran_Agustus' => DB::table('count_pengadaan')->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 9)->sum('total_qty'),
            'Pendapat_September' => DB::table('count_penjualan')->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 9)->sum('total_qty'),
            'Pengeluaran_September' => DB::table('count_pengadaan')->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 9)->sum('total_qty'),
            'Pendapat_Oktober' => DB::table('count_penjualan')->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 10)->sum('total_qty'),
            'Pengeluaran_Oktober' => DB::table('count_pengadaan')->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 10)->sum('total_qty'),
            'Pendapat_November' => DB::table('count_penjualan')->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 11)->sum('total_qty'),
            'Pengeluaran_November' => DB::table('count_pengadaan')->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 11)->sum('total_qty'),
            'Pendapat_Desember' => DB::table('count_penjualan')->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 12)->sum('total_qty'),
            'Pengeluaran_Desember' => DB::table('count_pengadaan')->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 12)->sum('total_qty'),

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
        $pengadaan = Pengadaan::when($req->bulan, fn($query) => $query->whereMonth('tgl_pengadaan', $req->bulan))
            ->when($req->tahun, fn($query) => $query->whereYear('tgl_pengadaan', $req->tahun))
            ->get();
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
        $penjualan = Penjualan::with('user')
            ->when($req->bulan, fn($query) => $query->whereMonth('tgl_penjualan', $req->bulan))
            ->when($req->tahun, fn($query) => $query->whereYear('tgl_penjualan', $req->tahun))
            ->get();
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

    Route::get('/laporan-reject', function(Request $req) {
        $reject = Reject::with('tanaman')
            ->when($req->bulan, fn($query) => $query->whereMonth('tgl_reject', $req->bulan))
            ->when($req->tahun, fn($query) => $query->whereYear('tgl_reject', $req->tahun))
            ->latest()->get();
        return view('laporan.reject', [
            'reject' => $reject,
        ]);
    });

    Route::get('/laporan-pengadaan-print', function(Request $req) {
        $pengadaan = Pengadaan::with('user', 'supplier', 'detail_pengadaan')
            ->when($req->bulan, fn($query) => $query->whereMonth('tgl_pengadaan', $req->bulan))
            ->when($req->tahun, fn($query) => $query->whereYear('tgl_pengadaan', $req->tahun))
            ->latest()->get();
        return view('laporan.pengadaan-print', [
            'pengadaan' => $pengadaan,
        ]);
    });

    Route::get('/laporan-penjualan-print', function(Request $req) {
        $penjualan = Penjualan::with('user', 'detail_penjualan')
            ->when($req->bulan, fn($query) => $query->whereMonth('tgl_penjualan', $req->bulan))
            ->when($req->tahun, fn($query) => $query->whereYear('tgl_penjualan', $req->tahun))
            ->latest()->get();
        return view('laporan.penjualan-print', [
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