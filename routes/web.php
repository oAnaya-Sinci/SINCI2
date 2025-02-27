<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Surveys\SurveyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Api\ApiEmailController;
use App\Exports\UsersExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

// This route only shows the PHP info of the server
// Route::get('/infoPHP', function(){ return view('info'); });

Route::get('/', function(){ return view('authenticate/loginUser'); });


Route::get('/dashboard', function(){
    $titulo = "DASHBOARD";
    return view('dashboard/main', compact('titulo'));
});

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

// Routes Survey
Route::get('/surveys/main', [SurveyController::class, 'index'])->name('surveys');
Route::get('/surveys/obtainSurveys', [SurveyController::class, 'obtainSurveys'])->name('obtain_surveys');
Route::get('/surveys/generatePDFSurveys/', [SurveyController::class, 'obtainPDFSurvey'])->name('pdf_surveys');
Route::post('/surveys/saveDataSurvey/', [SurveyController::class, 'store'])->name('save_surveys');
Route::post('/surveys/resend_emails/', [SurveyController::class, 'resend_emails'])->name('resend_emails');
//END

// Routes Exception Dates
Route::get('/exception-dates/main', [\App\Http\Controllers\exceptionDates\exceptionsController::class, 'index'])->name('exception_dates');
Route::get('/exception-dates/create', [\App\Http\Controllers\exceptionDates\exceptionsController::class, 'createException'])->name('create_exception');
Route::get('/exception-dates/obtainExceptions', [\App\Http\Controllers\exceptionDates\exceptionsController::class, 'obtainExceptions'])->name('obtain_exceptions');
// END

//Routes reports
Route::get('/reports', [ReportController::class, 'index'])->name('reports');
// Route::post('/generateReportPDF/', [ReportController::class, 'generatePDFToSendInEmail'])->name('reportPDF');

//Routes settings
Route::get('/settings', [SettingController::class, 'index'])->name('settings');
Route::get('/settings/edit/{setting}', [SettingController::class, 'edit'])->name('settings.edit');
Route::post('/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
Route::get('/settings/date/create', [SettingController::class, 'dateCreate'])->name('settings.date.create');
Route::post('/settings', [SettingController::class, 'dateStore'])->name('settings.date.store');
Route::get('/settings/date/edit/{date}', [SettingController::class, 'dateEdit'])->name('settings.date.edit');
Route::post('/settings/date/{date}', [SettingController::class, 'dateUpdate'])->name('settings.date.update');
Route::get('/settings/notifi/edit/{status}', [SettingController::class, 'statusEdit'])->name('settings.status.edit');
Route::post('/settings/notifi/{status}', [SettingController::class, 'statusUpdate'])->name('settings.status.update');

Route::any('/', function () {
    $currentDate = Date::now()->format('Y-m-d');
    $fileName = 'reporte_bitácoras_' . $currentDate . '.xlsx';
    [ReportController::class, 'filter'];
    return (new UsersExport)->department(request('department'))->office(request('office'))->download($fileName);
})->name('reports.filter');
