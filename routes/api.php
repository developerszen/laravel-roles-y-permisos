<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */
    Route::resource('users', UserController::class);
    /*
    |--------------------------------------------------------------------------
    | Comments posts
    |--------------------------------------------------------------------------
    */
    Route::post('posts/{post}/comments', [PostController::class, 'comment']);
    Route::post('posts/{post}/publish', [PostController::class, 'publish']);
    Route::post('posts/{post}/unpublish', [PostController::class, 'unpublish']);
    Route::post('posts/{post}/comments/{comment}', [PostController::class, 'salient']);
    /*
    |--------------------------------------------------------------------------
    | Posts
    |--------------------------------------------------------------------------
    */
    Route::post('posts', [PostController::class, 'store']);
    Route::get('posts/create', [PostController::class, 'create']);
    Route::resource('posts', PostController::class)->except(['show', 'create', 'store']);
});

Route::get('posts/{post}', [PostController::class, 'show']);