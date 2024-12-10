<?php


use App\Http\Controllers\Doctor\InvoiceController;
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
            Route::get('/', [InvoiceController::class,'index'])->name('invoices.index');
            Route::get('/edit/{id}', [InvoiceController::class,'edit'])->name('invoices.edit');
            Route::post('/update', [InvoiceController::class,'update'])->name('invoices.update');
            Route::get('/delete/{id}', [InvoiceController::class,'delete'])->name('invoices.delete');

        });
    });







});



require __DIR__.'/auth.php';

