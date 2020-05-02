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
        $unallowedUsers = ['0032613008','0023233133','0029985514','0026342213','0023518656','0025770421','0018185691','0023495391','0010432794','0016530493','0022794719','0018095638','0016356974','0025954068','0019360766','0010186581'];
        if ($user->tempat != null && $user->tl != null && $user->nis != null && $user->nisn != null && $user->komp != null) {
            return view('surat')->with('user', $user)->with('unallowedUsers', $unallowedUsers);
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
        $user->komp = $req->komp;
        $user->save();
        return redirect('/home');
    })->name('profile.update');
});