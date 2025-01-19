<?php


use App\Http\Controllers\LabEmployee\InvoiceController;
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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth:lab_employee']
    ], function(){

    Route::group(['prefix'=>'dashboard'],function(){

        //Dashboard lab employee//
        Route::get('lab_employee', function () {
            return view('dashboard.lab-employee-admin.dashboard');
        })->name('dashboard.lab_employee');
        //End Dashboard lab employee//


        Route::group(['prefix'=>'lab_employee_invoice'],function(){
            Route::get('/{case}',[InvoiceController::class,'index'])->name('dashboard.lab_employee_invoice.index');
            Route::get('/edit/{id}',[InvoiceController::class,'edit'])->name('dashboard.lab_employee_invoice.edit');
            Route::post('/update/{id}',[InvoiceController::class,'update'])->name('dashboard.lab_employee_invoice.update');
            Route::get('/show/{id}',[InvoiceController::class,'show'])->name('dashboard.lab_employee_invoice.show');
        });

    });

});



require __DIR__.'/auth.php';

