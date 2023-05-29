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
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('master-users', UserController::class);
    Route::resource('master-tiket', TiketController::class);
    Route::resource('master-chatbot', ChatbotController::class);
    Route::resource('master-faq', FaqController::class);
});

Route::get('/chatbot', [App\Http\Controllers\Pengguna\ChatbotController::class, 'index'])->name('chatbot');
Route::get('/pertanyaan', [App\Http\Controllers\Pengguna\PertanyaanController::class, 'index'])->name('pertanyaan');
Route::get('/kalender-akademik', [App\Http\Controllers\Pengguna\KalenderAkademikController::class, 'index'])->name('kalender-akademik');
Route::get('/layanan-akademik', [App\Http\Controllers\Pengguna\LayananAkademikController::class, 'index'])->name('layanan-akademik');
Route::get('/peraturan-akademik', [App\Http\Controllers\Pengguna\PeraturanAkademikController::class, 'index'])->name('peraturan-akademik');