<?php

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


Route::middleware('language')
    ->group(function () {
Route::resource('users',\App\Http\Controllers\UsersController::class);
Route::resource('photos',\App\Http\Controllers\PhotosController::class);
Route::resource('photos.comments', \App\Http\Controllers\CommentsController::class)->middleware('auth');
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });


Route::get('/language/{locale}', [\App\Http\Controllers\LanguageSwitcherController::class, 'switcher'])
    ->name('language.switcher')
    ->where('locale', 'en|ru');
