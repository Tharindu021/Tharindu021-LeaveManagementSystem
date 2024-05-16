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
    Route::get('/{user_id}/get', [UserController::class, "get"])->name('user.get');
    Route::get('/{user_id}/getFormData', [UserController::class, "getFormData"])->name('user.form.getFormData');
    Route::post('/{user_id}/update', [UserController::class, "update"])->name('user.form.update');
    Route::delete('/{user_id}/delete', [UserController::class, "delete"])->name('user.form.delete');
    Route::post('/{user_id}/updatePassword', [UserController::class, "updatePassword"])->name('user.form.updatePassword');

});
