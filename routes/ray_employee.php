<?php


use App\Http\Controllers\Doctor\DiagnosticController;
use App\Http\Controllers\Doctor\InvoiceController;
use App\Http\Controllers\Doctor\LabController;
use App\Http\Controllers\Doctor\PatientDetails;
use App\Http\Controllers\Doctor\RaysController;
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
Route::get('/sitebackend', [DashboardController::class,'index']);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth:ray_employee']
    ], function(){

    Route::group(['prefix'=>'dashboard'],function(){

        //Dashboard rays employee//
        Route::get('ray_employee', function () {
            return view('dashboard.ray-employee-admin.dashboard');
        })->name('dashboard.ray_employee');
        //End Dashboard rays employee//


    });

});



require __DIR__.'/auth.php';

