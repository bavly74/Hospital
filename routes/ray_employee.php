<?php


use App\Http\Controllers\RayEmployee\InvoiceController;
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


       Route::group(['prefix'=>'ray_employee_invoice'],function(){
           Route::get('/{case}',[InvoiceController::class,'index'])->name('dashboard.ray_employee_invoice.index');
           Route::get('/edit/{id}',[InvoiceController::class,'edit'])->name('dashboard.ray_employee_invoice.edit');
           Route::post('/update/{id}',[InvoiceController::class,'update'])->name('dashboard.ray_employee_invoice.update');

       });
    });

});



require __DIR__.'/auth.php';

