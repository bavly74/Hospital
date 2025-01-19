<?php

use App\Http\Controllers\PatientDashboard\PatientController;
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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth:patient']
    ], function(){

    Route::group(['prefix'=>'dashboard'],function(){

        //Dashboard patient//
        Route::get('patient', function () {
            return view('dashboard.patientDashboard.dashboard');
        })->name('dashboard.patientDashboard');
        //End Dashboard patient//

        Route::get('invoices', [PatientController::class,'invoices'])->name('dashboard.patientDashboard.invoices');
        Route::get('rays', [PatientController::class,'rays'])->name('dashboard.patientDashboard.rays');
        Route::get('labs', [PatientController::class,'labs'])->name('dashboard.patientDashboard.labs');
        Route::get('lab/show/{id}', [PatientController::class,'showLab'])->name('dashboard.patientDashboard.lab.show');
        Route::get('ray/show/{id}', [PatientController::class,'showRay'])->name('dashboard.patientDashboard.ray.show');


    });

});



require __DIR__.'/auth.php';

