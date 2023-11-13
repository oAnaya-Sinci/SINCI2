<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Api\ApiEmailController;
use App\Exports\UsersExport;
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

/**
 * @Author: `Carlos Omar Anaya Barajas`
 * @Date: 2022-03-14 13:48:29
 * @Desc: Ruta para el modulo de bitacoras en WEBSAS
 */
Route::get('/bitacoras/main', function(){ $titulo = "REGISTRO DE BITÁCORAS"; return view('bitacoras/main', compact('titulo')); });

/**
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-14 13:48:53
 * @Desc: Ruta para el modulo de Compras en WEBSAS
 */
Route::get('/compras/main', function(){ $titulo = "COMPRAS"; return view('compras/main', compact('titulo')); });
Route::get('/compras/plantillaPDF', function(){ $titulo = "PLANTILLA PDF"; return view('compras/plantillaPDF', compact('titulo')); });


//Routes users
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

//Routes reports
Route::get('/reports', [ReportController::class, 'index'])->name('reports');

//Routes settings
Route::get('/settings', [SettingController::class, 'index'])->name('settings');
Route::get('/settings/edit/{setting}', [SettingController::class, 'edit'])->name('settings.edit');
Route::post('/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
Route::get('/settings/date/create', [SettingController::class, 'dateCreate'])->name('settings.date.create');
Route::post('/settings', [SettingController::class, 'dateStore'])->name('settings.date.store');
Route::get('/settings/date/edit/{date}', [SettingController::class, 'dateEdit'])->name('settings.date.edit');
Route::post('/settings/date/{date}', [SettingController::class, 'dateUpdate'])->name('settings.date.update');

Route::any('/', function () {
    [ReportController::class, 'filter'];
    return (new UsersExport)->department(request('department'))->download('users.xlsx');
})->name('reports.filter');
