<?php

use Illuminate\Support\Facades\Route;
use PDF as PDF;
use Illuminate\Http\Request;
use App\User;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/print', function(Request $req) {
        $user = $req->user();
        if ($user->tempat != null && $user->tl != null && $user->nis != null && $user->nisn != null && $user->komp != null) {
            return view('surat')->with('user', $user);
        }

        return redirect()->back();
    })->name('print');
    
    Route::get('/profile', function(Request $req) {
        $user = $req->user();
        return view('profile')->with('user', $user);
    })->name('profile');
    
    Route::post('/profile', function(Request $req) {
        $user = User::find($req->user()->id);
        $user->name = $req->name;
        $user->tempat = $req->tempat_lahir;
        $user->tl = $req->tanggal_lahir;
        $user->nis = $req->nis;
        $user->nisn = $req->nisn;
        $user->komp = $req->komp;
        $user->save();
        return redirect('/home');
    })->name('profile.update');
});