<?php

use App\Events\TampilAntrian;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TiketController;
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


Route::get('/', function(){
   return view('welcome');
});
Route::get('/antrian', function(){
    return view('index');
});



Route::get('/tiket', [TiketController::class, 'index']);
Route::post('/tiket', [AntrianController::class, 'create'])->name('create-tiket');

Route::get('/login', [AuthController::class, 'index'])->middleware('guest');
Route::post('/login', [AuthController::class, 'auth'])->name('login');

Route::middleware(['auth'])->group(function () {
    // Your authenticated routes go here
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/loket', [DashboardController::class, 'loket'])->name('loket');
    
    Route::get('/antri', [AntrianController::class, 'index'])->name('daftar-antrian');
    Route::post('/antri/getantrian', [AntrianController::class, 'getAntrian'])->name('get-antrian');
    Route::get('/antri/currentantrian', [AntrianController::class, 'currentantrian'])->name('current-antrian');
    Route::post('/antri/antrianselesai', [AntrianController::class, 'antrianselesai'])->name('antrian-selesai');
    Route::get('/antri/riwayatantrian', [AntrianController::class, 'riwayatantrian'])->name('antrian-riwayat');
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
