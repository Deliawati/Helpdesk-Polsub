<?php

use App\Http\Controllers\Master\ChatbotController;
use App\Http\Controllers\Master\FaqController;
use App\Http\Controllers\Master\TiketController;
use App\Http\Controllers\Master\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('master-users', UserController::class);
    Route::resource('master-tiket', TiketController::class);
    Route::resource('master-chatbot', ChatbotController::class);
    Route::resource('master-faq', FaqController::class);
});
