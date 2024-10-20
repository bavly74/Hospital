<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SectionController;
use App\Http\Controllers\Backend\DoctorController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\GroupServiceController;
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
            Route::post('/store-section', [SectionController::class,'store'])->name('section.store');
            Route::post('/update-section', [SectionController::class,'update'])->name('section.update');
            Route::post('/delete-section', [SectionController::class,'delete'])->name('section.delete');
        });

//end sections



//doctors
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/doctors', [DoctorController::class,'index'])->name('doctors.index');
    Route::get('/create-doctor', [DoctorController::class,'create'])->name('doctors.create');
    Route::get('/edit-doctor/{id}', [DoctorController::class,'edit'])->name('doctors.edit');
    Route::post('/store-doctor', [DoctorController::class,'store'])->name('doctors.store');
    Route::post('/delete-doctors', [DoctorController::class,'delete'])->name('doctors.delete_select');
    Route::post('/update-doctor', [DoctorController::class,'update'])->name('doctors.update');
    Route::post('/delete-doctor', [DoctorController::class,'delete'])->name('doctors.delete');
    Route::post('/update-password-doctor', [DoctorController::class,'updatePassword'])->name('doctors.updatePassword');
    Route::post('/update-status-doctor', [DoctorController::class,'updateStatus'])->name('doctors.updateStatus');

});
//end doctors


//services
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/single-services', [ServiceController::class,'index'])->name('single-services.index');
    Route::post('/single-services/store', [ServiceController::class,'store'])->name('single-services.store');
    Route::post('/single-services/update', [ServiceController::class,'update'])->name('single-services.update');
    Route::post('/single-services/delete', [ServiceController::class,'delete'])->name('single-services.delete');

});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/group-service', [GroupServiceController::class,'create'])->name('group-service.create');
    Route::post('/group-service/store', [GroupServiceController::class,'store'])->name('group-service.store');

    // Route::post('/single-services/update', [ServiceController::class,'update'])->name('single-services.update');
    // Route::post('/single-services/delete', [ServiceController::class,'delete'])->name('single-services.delete');

});


});
require __DIR__.'/auth.php';

