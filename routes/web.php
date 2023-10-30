<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
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
Route::group(['as' => 'auth.'], function () {
    Route::group(['middleware' => ['signout'],], function () {
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register', [AuthController::class, 'doRegister'])->name('doRegister');

        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'doLogin'])->name('doLogin');
    });
});

Route::group(['middleware' => ['auth'],], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/signout', [AuthController::class, 'signOut'])->name('auth.signout');
});
Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/create', [BlogController::class, 'create'])->name('create');
    Route::post('/store', [BlogController::class, 'store'])->name('store');
    Route::post('/like/{id}', [BlogController::class, 'like'])->name('like')->middleware('auth');
});
