<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');

Route::post('/login', [LoginController::class, 'store'])->middleware('guest');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::post('/logout', [LogoutController::class, 'logout'])->middleware('Auth')->name('logout');

Route::get('/verify-email', [EmailVerificationController::class, 'notice'])->middleware('Auth')
    ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['Auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
    ->middleware(['Auth', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])->middleware('guest')
    ->name('password.update');
