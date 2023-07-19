<?php

use App\Http\Controllers\Master\ChatbotController;
use App\Http\Controllers\Master\FaqController;
use App\Http\Controllers\Master\FileController;
use App\Http\Controllers\Master\InfoAkademik\KalenderController;
use App\Http\Controllers\Master\InfoAkademik\LayananController;
use App\Http\Controllers\Master\InfoAkademik\PeraturanController;
use App\Http\Controllers\Master\TiketController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('modul-tiket', TiketController::class);
    Route::resource('modul-chatbot', ChatbotController::class);
    Route::delete('modul-chatbot/attachment/{id}', [FileController::class, 'deleteAttachment'])->name('attachment.delete');
    Route::resource('modul-faq', FaqController::class);
    Route::resource('master-layanan-akademik', LayananController::class);
    Route::resource('master-kalender-akademik', KalenderController::class);
    Route::resource('master-peraturan-akademik', PeraturanController::class);
    Route::resource('master-users', UserController::class);
});

Route::get('/chatbot', [App\Http\Controllers\Pengguna\ChatbotController::class, 'index'])->name('chatbot');

Route::get('/faq', [App\Http\Controllers\Pengguna\PertanyaanController::class, 'faq'])->name('faq');
Route::get('/pertanyaan', [App\Http\Controllers\Pengguna\PertanyaanController::class, 'index'])->name('pertanyaan');
Route::post('/pertanyaan', [App\Http\Controllers\Pengguna\PertanyaanController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('pertanyaan.store');

Route::get('/kalender-akademik', [App\Http\Controllers\Pengguna\KalenderAkademikController::class, 'index'])->name('kalender-akademik');

Route::get('/layanan-akademik', [App\Http\Controllers\Pengguna\LayananAkademikController::class, 'index'])->name('layanan-akademik');

Route::get('/peraturan-akademik', [App\Http\Controllers\Pengguna\PeraturanAkademikController::class, 'index'])->name('peraturan-akademik');
