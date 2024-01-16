<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SectionController;
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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
       

//Dashboard user//
Route::get('/dashboard/user', function () {
    return view('dashboard.user.dashboard');
})->middleware(['auth'])->name('dashboard.user');
//End Dashboard user//


//Dashboard admin//
Route::get('/dashboard/admin', function () {
    return view('dashboard.admin.dashboard');
})->middleware(['auth:admin'])->name('dashboard.admin');
//End Dashboard admin//


//sections
        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/section', [SectionController::class,'index'])->name('section.index');
            
        });

//end sections



});
require __DIR__.'/auth.php';

