<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\GetUserController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile/delete/{id}', [AuthController::class, 'deleteProfile'])->name('profile.delete');
});

// Admin Dashboard Route (without middleware, but still can check role in controller)
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

// Default route
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::resource('kategori', KategoriController::class)->middleware('role:admin');
Route::resource('barang', BarangController::class)->middleware('role:admin');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::resource('users', GetUserController::class);