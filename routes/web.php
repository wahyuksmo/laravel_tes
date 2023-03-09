<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/swapvaribale', [DashboardController::class, 'swapvariable']);
Route::get('/ubah', [DashboardController::class, 'ubahAngkaMenjadiKata']);
Route::get('/add_user', [DashboardController::class, 'add_user'])->middleware('auth');
Route::post('/store_user', [DashboardController::class, 'store_user'])->middleware('auth');
Route::post('/delete_user', [DashboardController::class, 'delete_user'])->middleware('auth');
Route::get('/edit_user/{id}', [DashboardController::class, 'edit_user'])->middleware('auth');
Route::post('/update_user', [DashboardController::class, 'update_user'])->middleware('auth');

Route::get('/product_stock', [ApiController::class, 'product_stock'])->middleware('auth');
Route::get('/user_api', [ApiController::class, 'user_api'])->middleware('guest');

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'regisProses']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses']);
Route::post('/logout', [AuthController::class, 'logout']);