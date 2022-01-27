<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\HomeController AS home;
// use App\Http\Controllers\Auth\logoutController AS logout;
// use Illuminate\Support\Facades\Auth;

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

/** 
 * @Author: Carlos Omar Anaya Barajas 
 * @Date: 2022-01-19 18:11:15 
 * @Desc: This block of routes was made for the new SINCI ADMIN SISTEM.
 */

// Auth::routes([
//     'login'    => true,
//     'logout'   => false,
//     'register' => false,
//     'reset'    => false,   // for resetting passwords
//     'confirm'  => false,  // for additional password confirmations
//     'verify'   => false,  // for email verification
// ]);

// Route::group(['middleware'=>['auth']],function(){

//     // Route::get('/', [home::class, 'index'])->name('home');
//     Route::get('/', function(){ $titulo = "DASHBOARD"; $userName = Auth()->user()->ID_USUARIO . " - " . Auth()->user()->NOMBRE; $userData = json_encode([Auth()->user()->ADMINISTRADOR, Auth()->user()->ID_USUARIO]); return view('dashboard/main', compact('titulo', 'userName', 'userData')); });
    
//     Route::get('/bitacoras/main', function(){ $titulo = "REGISTRO DE BITACORAS"; $userName = Auth()->user()->ID_USUARIO . " - " . Auth()->user()->NOMBRE; $userData = json_encode([Auth()->user()->ADMINISTRADOR, Auth()->user()->ID_USUARIO]); return view('bitacoras/main', compact('titulo', 'userName', 'userData')); });
    
//     /** Logout */
//     Route::post('/logout', [logout::class, 'logout']);
// });

// This route only shows the PHP info of the server
// Route::get('/infoPHP', function(){ return view('info'); });

Route::get('/', function(){ return view('authenticate/loginUser'); });

Route::get('/dashboard', function(){ $titulo = "DASHBOARD"; return view('dashboard/main', compact('titulo')); });

Route::get('/bitacoras/main', function(){ $titulo = "REGISTRO DE BITACORAS"; return view('bitacoras/main', compact('titulo')); });