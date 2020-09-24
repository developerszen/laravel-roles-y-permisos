<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;

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
    Route::apiResource('users', UserController::class)->except(['destroy']);
    /*
    |--------------------------------------------------------------------------
    | Comments
    |--------------------------------------------------------------------------
    */
    Route::post('posts/{post}/comments', [CommentController::class, 'store']);
    Route::post('posts/comments/{comment}/salient', [CommentController::class, 'salient']);
    /*
    |--------------------------------------------------------------------------
    | Posts
    |--------------------------------------------------------------------------
    */
    Route::post('posts', [PostController::class, 'store']);
    Route::post('posts/{post}/publish', [PostController::class, 'publish']);
    Route::post('posts/{post}/unpublish', [PostController::class, 'unpublish']);
    Route::apiResource('posts', PostController::class)->except(['show', 'store']);
});

Route::get('posts/{post}', [PostController::class, 'show']);