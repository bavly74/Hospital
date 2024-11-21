<?php

use App\Http\Controllers\Backend\AmbulanceController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\InsuranceController;
use App\Http\Controllers\Backend\PatientController;
use App\Http\Controllers\Backend\ReceiptController;
use App\Http\Controllers\Backend\SectionController;
use App\Http\Controllers\Backend\DoctorController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\PaymentController;
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


    //Dashboard doctor//
    Route::get('/dashboard/doctor', function () {
        return view('dashboard.doctor-admin.dashboard');
    })->middleware(['auth:doctor'])->name('dashboard.doctor');
    //End Dashboard doctor//


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
        Route::view('/group-service/create','livewire.group-service.include-create')->name('group-service.create');
    });

    //insurance
    Route::prefix('insurance')->middleware('auth:admin')->group(function () {
            Route::get('/', [InsuranceController::class,'index'])->name('insurance.index');
            Route::get('/create', [InsuranceController::class,'create'])->name('insurance.create');
            Route::post('/store', [InsuranceController::class,'store'])->name('insurance.store');
            Route::get('/edit/{id}', [InsuranceController::class,'edit'])->name('insurance.edit');
            Route::put('/update', [InsuranceController::class,'update'])->name('insurance.update');
            Route::delete('/destroy', [InsuranceController::class,'destroy'])->name('insurance.destroy');

    });
    //end insurance


    //ambulance
    Route::prefix('ambulance')->middleware('auth:admin')->group(function () {
        Route::get('/', [AmbulanceController::class,'index'])->name('ambulance.index');
        Route::get('/create', [AmbulanceController::class,'create'])->name('ambulance.create');
        Route::post('/store', [AmbulanceController::class,'store'])->name('ambulance.store');
        Route::get('/edit/{id}', [AmbulanceController::class,'edit'])->name('ambulance.edit');
        Route::put('/update', [AmbulanceController::class,'update'])->name('ambulance.update');
        Route::delete('/destroy', [AmbulanceController::class,'destroy'])->name('ambulance.destroy');
    });

    //end ambulance


    //patient
    Route::prefix('patient')->middleware('auth:admin')->group(function () {
        Route::get('/', [PatientController::class,'index'])->name('patient.index');
        Route::get('/create', [PatientController::class,'create'])->name('patient.create');
        Route::post('/store', [PatientController::class,'store'])->name('patient.store');
        Route::get('/edit/{id}', [PatientController::class,'edit'])->name('patient.edit');
        Route::get('/show/{id}', [PatientController::class,'show'])->name('patient.show');
        Route::put('/update', [PatientController::class,'update'])->name('patient.update');
        Route::delete('/destroy', [PatientController::class,'destroy'])->name('patient.destroy');
    });
    //end patient


    //single invoice
    Route::middleware(['auth:admin'])->group(function () {
        Route::view('/single-invoice/create','livewire.single-invoice.index')->name('single-invoice');
        Route::view('/single-invoice/print','livewire.single-invoice.print')->name('single-invoice.print');

    });
    //end single invoice


    //group invoice
    Route::middleware(['auth:admin'])->group(function () {
        Route::view('/group-invoice/create','livewire.group-invoice.index')->name('group-invoice');
        Route::view('/group-invoice/print','livewire.group-invoice.print')->name('group-invoice.print');

    });
    //end group invoice


    //receipt
    Route::prefix('receipt')->middleware('auth:admin')->group(function () {
       Route::get('/', [ReceiptController::class,'index'])->name('receipt.index');
       Route::get('/create', [ReceiptController::class,'create'])->name('receipt.create');
       Route::post('/store', [ReceiptController::class,'store'])->name('receipt.store');
       Route::get('/edit/{id}', [ReceiptController::class,'edit'])->name('receipt.edit');
        Route::get('/show/{id}', [ReceiptController::class,'show'])->name('receipt.show');
        Route::put('/update', [ReceiptController::class,'update'])->name('receipt.update');
       Route::delete('/destroy', [ReceiptController::class,'destroy'])->name('receipt.destroy');
    }) ;
    //end receipt


    //payment
    Route::prefix('payment')->middleware('auth:admin')->group(function () {
        Route::get('/', [PaymentController::class,'index'])->name('payment.index');
        Route::get('/create', [PaymentController::class,'create'])->name('payment.create');
        Route::post('/store', [PaymentController::class,'store'])->name('payment.store');
        Route::get('/edit/{id}', [PaymentController::class,'edit'])->name('payment.edit');
        Route::put('/update', [PaymentController::class,'update'])->name('payment.update');
        Route::get('/show/{id}', [PaymentController::class,'show'])->name('payment.show');

        Route::delete('/destroy', [PaymentController::class,'destroy'])->name('payment.destroy');
     }) ;
     //end payment
    });



require __DIR__.'/auth.php';

