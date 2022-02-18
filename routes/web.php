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

    if (Auth::attempt(['email' => $req->email, 'password' => $req->password, 'status' => null])) {
        $req->session()->regenerate();

        return redirect()->intended('/dashboard?tahun=' . date('Y'))->with('success', 'Login sukses');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

Route::middleware('is_login')->group(function() {

    Route::get('/dashboard', function(Request $req) {
        $penjualan = Penjualan::where('status', null)->get();

        $total_penjualan = 0;
        foreach ($penjualan as $p) {
            if ($p->detail_penjualan) {
                foreach ($p->detail_penjualan as $dp) {
                    $total_penjualan += $dp->qty;
                }
            }
        }
        $pengadaan = Pengadaan::where('status', null)->get();

        $total_pengadaan = 0;
        foreach ($pengadaan as $p) {
            if ($p->detail_pengadaan) {
                foreach ($p->detail_pengadaan as $dp) {
                    $total_pengadaan += $dp->qty;
                }
            }
        }


        return view('dashboard', [
            'title' => 'Dashboard',
            'total_tanaman' => Tanaman::where('status', null)->sum('stok'),
            'total_penjualan' => $total_penjualan,
            'total_pengadaan' => $total_pengadaan,
            'total_reject' => Reject::where('status', '!=', 9)->sum('qty'),
            'Pendapat_Januari' => Penjualan::where('status', null)->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 1)->sum('total'),
            'Pengeluaran_Januari' => Pengadaan::where('status', null)->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 1)->sum('total'),
            'Pendapat_Februari' => Penjualan::where('status', null)->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 2)->sum('total'),
            'Pengeluaran_Februari' => Pengadaan::where('status', null)->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 2)->sum('total'),
            'Pendapat_Maret' => Penjualan::where('status', null)->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 3)->sum('total'),
            'Pengeluaran_Maret' => Pengadaan::where('status', null)->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 3)->sum('total'),
            'Pendapat_April' => Penjualan::where('status', null)->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 4)->sum('total'),
            'Pengeluaran_April' => Pengadaan::where('status', null)->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 4)->sum('total'),
            'Pendapat_Mai' => Penjualan::where('status', null)->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 5)->sum('total'),
            'Pengeluaran_Mai' => Pengadaan::where('status', null)->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 5)->sum('total'),
            'Pendapat_Juni' => Penjualan::where('status', null)->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 6)->sum('total'),
            'Pengeluaran_Juni' => Pengadaan::where('status', null)->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 6)->sum('total'),
            'Pendapat_Juli' => Penjualan::where('status', null)->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 7)->sum('total'),
            'Pengeluaran_Juli' => Pengadaan::where('status', null)->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 7)->sum('total'),
            'Pendapat_Agustus' => Penjualan::where('status', null)->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 9)->sum('total'),
            'Pengeluaran_Agustus' => Pengadaan::where('status', null)->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 9)->sum('total'),
            'Pendapat_September' => Penjualan::where('status', null)->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 9)->sum('total'),
            'Pengeluaran_September' => Pengadaan::where('status', null)->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 9)->sum('total'),
            'Pendapat_Oktober' => Penjualan::where('status', null)->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 10)->sum('total'),
            'Pengeluaran_Oktober' => Pengadaan::where('status', null)->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 10)->sum('total'),
            'Pendapat_November' => Penjualan::where('status', null)->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 11)->sum('total'),
            'Pengeluaran_November' => Pengadaan::where('status', null)->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 11)->sum('total'),
            'Pendapat_Desember' => Penjualan::where('status', null)->whereYear('tgl_penjualan', $_GET['tahun'])->whereMonth('tgl_penjualan', 12)->sum('total'),
            'Pengeluaran_Desember' => Pengadaan::where('status', null)->whereYear('tgl_pengadaan', $_GET['tahun'])->whereMonth('tgl_pengadaan', 12)->sum('total'),

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