<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

Route::get('/', [PostController::class, 'index']);

Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::get('posts/create', [PostController::class, 'create'])->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->middleware('auth');
Route::put('/posts/{post}/like', [PostController::class, 'like'])->middleware('auth');
Route::put('/posts/{post}/unlike', [PostController::class, 'unlike']);
Route::post('/posts/{post}/comment', [PostController::class, 'comment'])->middleware('auth');
Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
Route::put('posts/{post}', [PostController::class, 'update']);
Route::delete('posts/{post}', [PostController::class, 'delete']);

Route::get('/posts/{post}', [PostController::class, 'show']);
