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
   
});
Route::get('/antrian', function(){
    return view('index');
});

Route::get('/tiket', [TiketController::class, 'index']);
Route::post('/tiket', [AntrianController::class, 'create'])->name('create-tiket');

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'auth'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/antri', [AntrianController::class, 'index'])->name('daftar-antrian');
Route::post('/antri/getantrian', [AntrianController::class, 'getAntrian'])->name('get-antrian');
Route::get('/antri/currentantrian', [AntrianController::class, 'currentantrian'])->name('current-antrian');
Route::post('/antri/antrianselesai', [AntrianController::class, 'antrianselesai'])->name('antrian-selesai');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
