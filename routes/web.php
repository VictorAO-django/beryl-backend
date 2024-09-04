<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class,'index'])->name('user.index');
Route::post('/users', [UserController::class,'store'])->name('user.store');
Route::get('/users/{id}', [UserController::class,'show'])->name('user.show');
Route::patch('/user/{id}', [UserController::class,'update'])->name('user.update');
