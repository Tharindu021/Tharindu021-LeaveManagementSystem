<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, "index"])->name('dashboard');

Route::prefix('user-management')->group(function () {
    Route::get('/', [UserController::class, "index"])->name('user.index');
    Route::post('/store', [UserController::class, "store"])->name('user.store');
    Route::get('/all', [UserController::class, "all"])->name('user.all');

});
