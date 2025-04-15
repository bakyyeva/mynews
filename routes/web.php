<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'show'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);



Route::get('profile/{id}', [ProfileController::class, 'profile'])->name('profile')->whereNumber('id');
Route::get('profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit')->whereNumber('id');
Route::post('profile/edit/{id}', [ProfileController::class, 'update'])->whereNumber('id');
Route::post('password-change', [ProfileController::class, 'passwordChange'])->name('password-change');

Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.home');

Route::get('news', [NewsController::class, 'index'])->name('new.list');
Route::get('new/create', [NewsController::class, 'create'])->name('new.create');
Route::post('new/create', [NewsController::class, 'store']);
Route::get('new/{id}/edit', [NewsController::class, 'edit'])->name('new.edit')->whereNumber('id');
Route::post('new/{id}/edit', [NewsController::class, 'update'])->whereNumber('id');
Route::delete('new/delete', [NewsController::class, 'delete'])->name('new.delete');


Route::get('users', [UserController::class, 'index'])->name('user.list');
Route::get('user/create', [UserController::class, 'create'])->name('user.create');
Route::post('user/create', [UserController::class, 'store']);
Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit')->whereNumber('id');
Route::post('user/{id}/edit', [UserController::class, 'update'])->whereNumber('id');
Route::delete('user/delete', [UserController::class, 'delete'])->name('user.delete');

