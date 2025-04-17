<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProfileController as FrontProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthController::class, 'show'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('front-profile/{id}', [FrontProfileController::class, 'profile'])->name('front.profile')->whereNumber('id');
Route::get('front-profile/edit/{id}', [FrontProfileController::class, 'edit'])->name('front.profile.edit')->whereNumber('id');
Route::post('front-profile/edit/{id}', [FrontProfileController::class, 'update'])->whereNumber('id');
Route::post('password-change', [ProfileController::class, 'passwordChange'])->name('password-change');

Route::get('/', [HomeController::class, 'index'])->name('front.index');
Route::get('news/page', [HomeController::class, 'paginateNews'])->name('news.paginate');
Route::get('news/{id}/detail', [HomeController::class, 'newsDetail'])->name('news.detail');
Route::get('news/{id}/list', [HomeController::class, 'newsList'])->name('news.auth-list');
Route::get('news/create', [HomeController::class, 'newsCreate'])->name('front.new-create');
Route::post('news/create', [HomeController::class, 'newsStore']);
Route::get('news/{id}/edit', [HomeController::class, 'newsEdit'])->name('front.news-edit')->whereNumber('id');
Route::post('news/{id}/edit', [HomeController::class, 'newsUpdate']);



Route::prefix('admin')->middleware(['auth'])->group(function (){

    Route::get('/', [DashboardController::class, 'index'])->name('admin.home');

    Route::get('users', [UserController::class, 'index'])->name('user.list');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/create', [UserController::class, 'store']);
    Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->whereNumber('id');
    Route::post('user/{user}/edit', [UserController::class, 'update'])->whereNumber('id');
    Route::delete('user/delete', [UserController::class, 'delete'])->name('user.delete');

    Route::get('news', [NewsController::class, 'index'])->name('new.list');
    Route::get('new/create', [NewsController::class, 'create'])->name('new.create');
    Route::post('new/create', [NewsController::class, 'store']);
    Route::get('new/{id}/edit', [NewsController::class, 'edit'])->name('new.edit')->whereNumber('id');
    Route::post('new/{id}/edit', [NewsController::class, 'update'])->whereNumber('id');
    Route::delete('new/delete', [NewsController::class, 'delete'])->name('new.delete');

    Route::get('profile/{id}', [ProfileController::class, 'profile'])->name('profile')->whereNumber('id');
    Route::get('profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit')->whereNumber('id');
    Route::post('profile/edit/{id}', [ProfileController::class, 'update'])->whereNumber('id');

});

