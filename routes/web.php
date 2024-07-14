<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return redirect()->route('cars.index');
    });

    Route::resource('users', UserController::class);
    Route::resource('cars', CarController::class);
    Route::resource('parts', PartController::class);
});