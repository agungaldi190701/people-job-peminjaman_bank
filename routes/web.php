<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\nasabahController;
use App\Http\Controllers\pinjamanController;
use App\Http\Controllers\setoranController;
use App\Http\Controllers\syaratController;
use App\Http\Controllers\userController;
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

Route::get('/', function () {
    return view('home');
});

//Nasabah
Route::get('/data-nasabah', [nasabahController::class, 'index'])->middleware('auth');
Route::get('/data-nasabah/edit/{id}', [nasabahController::class, 'edit'])->middleware('auth');
Route::post('/upload-nasabah', [nasabahController::class, 'store'])->middleware('auth');
Route::post('/data-nasabah/update/{id}', [nasabahController::class, 'update'])->middleware('auth');
Route::delete('hapus-nasabah/{id}', [nasabahController::class, 'destroy'])->middleware('auth');

Route::post('/upload-syarat/{id}', [syaratController::class, 'store'])->middleware('auth');
Route::post('/update-syarat/{id}', [syaratController::class, 'update'])->middleware('auth');

Route::post('/upload-pinjaman', [pinjamanController::class, 'store'])->middleware('auth');
Route::post('/update-pinjaman/{id}', [pinjamanController::class, 'update'])->middleware('auth');

Route::get('/setoran', [setoranController::class, 'index'])->middleware('auth');
Route::get('/lihat-setoran/{id}/{idN}', [setoranController::class, 'show'])->middleware('auth');
Route::post('/upload-setoran', [setoranController::class, 'store'])->middleware('auth');




// login
Route::get('/login', [loginController::class, 'index']);
Route::post('/masuk', [loginController::class, 'authenticate'])->middleware('guest');
Route::get('/logout', [loginController::class, 'logout'])->middleware('auth');

// Registrasi
Route::get('/register', [loginController::class, 'register']);
Route::post('/registrasi', [userController::class, 'registrasi'])->middleware('guest');