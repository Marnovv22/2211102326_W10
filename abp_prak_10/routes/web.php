<?php

use App\Http\Controllers\LaundryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LaundryController::class, 'index']);
Route::post('/store', [LaundryController::class, 'store']);
Route::get('/edit/{id}', [LaundryController::class, 'edit']);
Route::post('/update/{id}', [LaundryController::class, 'update']);
Route::get('/delete/{id}', [LaundryController::class, 'destroy']);