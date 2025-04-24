<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::post('/adduser', [AuthController::class, 'addUser'])->name('user.post');

// Default route
Route::get('/', function () {
    return redirect()->route('dashboard');
});