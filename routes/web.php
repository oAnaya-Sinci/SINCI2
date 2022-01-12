<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController AS home;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes([
    'login'    => true,
    'logout'   => true,
    'register' => true,
    'reset'    => false,   // for resetting passwords
    'confirm'  => false,  // for additional password confirmations
    'verify'   => true,  // for email verification
]);

Route::group(['middleware'=>['auth']],function(){

    Route::get('/', [home::class, 'index'])->name('home');

    // Route::get('/main/Bitacora', function(){ return view('welcome'); });
});


Route::get('/bitacoras/main', function(){ return view('bitacoras/main'); });

Route::get('/layout/app', function(){ return view('layouts/app'); });