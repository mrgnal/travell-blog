<?php

use App\Http\Controllers\LabController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CheckName;
use App\Http\Middleware\TestMiddleware;

Route::get('/', [LabController::class, 'index']);
Route::get('/about', [LabController::class, 'about'])->middleware(CheckAge::class);
Route::get('/contact', [LabController::class, 'contact'])->middleware(TestMiddleware::class);
Route::get('/hobbies', [LabController::class, 'hobbies'])->middleware(CheckName::class);
Route::resource('posts', PostController::class);
Route::resource('comments', CommentController::class);
Route::resource('users', UserController::class);
Route::resource('tags', TagController::class);
