<?php

use Illuminate\Support\Facades\Route;
use App\Controllers\UserController;
use App\Controllers\OrderController;

Route::get('/users', [UserController::class, 'index']);
Route::get('/orders', [OrderController::class, 'index']);
