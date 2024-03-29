<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GaleriController;

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

Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'proseslogin']);
Route::get('/register', [UserController::class, 'register']);

Route::post('/simpanreg', [UserController::class, 'saveregister']);

Route::resource('galeri',GaleriController::class)->middleware('auth');

Route::post('hapusfoto/{id}', [GaleriController::class, 'delete']);

Route::get('logout', [UserController::class, 'logout']);

