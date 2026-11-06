<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterdUserController;
use App\Http\Controllers\SessionController;

Route::get('/', function () {return view('welcome');});

Route::get('/register', [RegisterdUserController::class, 'create']);
Route::post('/register', [RegisterdUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class,'destroy']);
