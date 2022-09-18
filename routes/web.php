<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\UserController;
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

Route::get('/', [PostController::class, 'index'])->name("posts.index");
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store']);

Route::get('/works', [WorkController::class, 'index'])->name("works.index");
Route::get('/works/create', [WorkController::class, 'create']);
Route::post('/works', [WorkController::class, 'store']);
Route::get('/works/{work}/edit', [WorkController::class, 'edit']);
Route::put('/works/{work}/update', [WorkController::class, 'update']);

Route::get('/setting', [UserController::class, 'edit'])->name("user.setting");
Route::put('/setting', [UserController::class, 'update']);
Route::put('/setting/password', [UserController::class, 'updatePass']);



require __DIR__.'/auth.php';
