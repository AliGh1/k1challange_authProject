<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::view('/', 'welcome');

Route::get('/profile', [ProfileController::class, 'index'])->middleware(['Auth','verified']);

Route::match(['put','patch'],'/user/{user}', [UserController::class, 'update'])->name('user.update');

Route::match(['put','patch'],'/user/change_password/{user}', [UserController::class, 'changePassword'])->name('user.change');

Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

require __DIR__.'/auth.php';

