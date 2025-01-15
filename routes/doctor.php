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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth:doctor']
    ], function(){

    Route::group(['prefix'=>'dashboard'],function(){

        //Dashboard doctor//
        Route::get('doctor', function () {
            return view('dashboard.doctor-admin.dashboard');
        })->name('dashboard.doctor');
        //End Dashboard doctor//

        Route::group(['prefix'=>'invoices'],function(){
            Route::get('/{status}', [InvoiceController::class,'index'])->name('invoices.index');
            Route::get('/edit/{id}', [InvoiceController::class,'edit'])->name('invoices.edit');
            Route::post('/update', [InvoiceController::class,'update'])->name('invoices.update');
            Route::get('/delete/{id}', [InvoiceController::class,'delete'])->name('invoices.delete');
        });

        Route::group(['prefix'=>'diagnostic'],function(){
            Route::post('/store', [DiagnosticController::class,'store'])->name('diagnostic.store');
            Route::get('/show/{id}', [DiagnosticController::class,'show'])->name('diagnostic.show');
            Route::post('/store-review', [DiagnosticController::class,'storeReview'])->name('diagnostic.storeReview');
        });

        Route::group(['prefix'=>'rays'],function(){
            Route::post('/store', [RaysController::class,'store'])->name('rays.store');
            Route::post('/update/{id}', [RaysController::class,'update'])->name('rays.update');
            Route::post('/destroy/{id}', [RaysController::class,'destroy'])->name('rays.destroy');
            Route::get('/show/{id}', [RaysController::class,'show'])->name('rays.show');
        });

        Route::group(['prefix'=>'labs'],function(){
            Route::post('/store', [LabController::class,'store'])->name('labs.store');
            Route::post('/update/{id}', [LabController::class,'update'])->name('labs.update');
            Route::post('/destroy/{id}', [LabController::class,'destroy'])->name('labs.destroy');
        });

        Route::group(['prefix'=>'patient'],function(){
            Route::get('/details/{id}', [PatientDetails::class,'index'])->name('patient.index');
        });
    });







});



require __DIR__.'/auth.php';

