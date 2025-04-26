<?php

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

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\WaliMuridController;

Route::get('/', [SiswaController::class, 'index'])->name('index');

Route::resource('kelas', KelasController::class);
Route::resource('wali-murid', WaliMuridController::class);
Route::resource('siswa', SiswaController::class);

