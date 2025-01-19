<?php

use App\Http\Controllers\Auth\AdminAuth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\DoctorAuthController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\LabEmployeeAuth;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\PatientAuth;
use App\Http\Controllers\Auth\RayEmployeeAuth;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){


//################################## Route User ##############################################

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest')->name('login.user');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout.user');

//################################## Route Admin ##############################################

Route::post('/login/admin', [AdminAuth::class, 'store'])->middleware('guest')->name('login.admin');

Route::post('/logout/admin', [AdminAuth::class, 'destroy'])->middleware('auth:admin')->name('logout.admin');

//#############################################################################################


//################################## Route Doctor ##############################################

Route::post('/login/doctor', [DoctorAuthController::class, 'store'])->middleware('guest')->name('login.doctor');

Route::post('/logout/doctor', [DoctorAuthController::class, 'destroy'])->middleware('auth:doctor')->name('logout.doctor');

//#############################################################################################


//################################## Route ray_employee ##############################################

Route::post('/login/ray_employee', [RayEmployeeAuth::class, 'store'])->middleware('guest')->name('login.ray_employee');

Route::post('/logout/ray_employee', [RayEmployeeAuth::class, 'destroy'])->middleware('auth:ray_employee')->name('logout.ray_employee');

//#############################################################################################

//################################## Route lab_employee ##############################################

    Route::post('/login/lab_employee', [LabEmployeeAuth::class, 'store'])->middleware('guest')->name('login.lab_employee');

    Route::post('/logout/lab_employee', [LabEmployeeAuth::class, 'destroy'])->middleware('auth:lab_employee')->name('logout.lab_employee');

//#############################################################################################


//################################## Route patient ##############################################

    Route::post('/login/patient', [PatientAuth::class, 'store'])->middleware('guest')->name('login.patient');

    Route::post('/logout/patient', [PatientAuth::class, 'destroy'])->middleware('auth:patient')->name('logout.patient');

//#############################################################################################

});



Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware('auth')
    ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout.user');
