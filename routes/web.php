<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'login');

Route::post('/auth', function(Request $req) {
    // User::create([
    //     'email' => 'mhs@admin.com',
    //     'password' => Hash::make('Admin123'),
    // ]);

    $credentials = $req->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $req->session()->regenerate();

        return redirect()->intended('dashboard')->with('success', 'Login sukses');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

Route::middleware('auth_owner', 'auth_admin')->group(function() {

    Route::get('/dashboard', function(Request $req) {
        return view('dashboard', ['title' => 'Dashboard']);
    });

    Route::resource('/user', UserController::class);

    Route::get('/logout', function(Request $req) {
        Auth::logout();

        $req->session()->invalidate();
    
        $req->session()->regenerateToken();
    
        return redirect('/')->with('success', 'Login sukses !');
    });

});