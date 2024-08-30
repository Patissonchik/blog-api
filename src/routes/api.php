<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('users', UserController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('comments', CommentController::class);

Route::get('users/{user}/posts', [UserController::class, 'getPosts']);
Route::get('users/{user}/comments', [UserController::class, 'getComments']);
Route::get('posts/{post}/comments', [PostController::class, 'getComments']);
