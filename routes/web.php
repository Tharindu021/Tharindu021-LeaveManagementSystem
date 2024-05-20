<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveDataController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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

Route::prefix('permission')->group(function () {
    Route::get('/', [PermissionController::class, "index"])->name('permission.index');
    Route::get('/all', [PermissionController::class, "all"])->name('permission.all');
    Route::get('/allGroup', [PermissionController::class, "allGroup"])->name('permission.allGroup');
    Route::post('/{user_id}/update', [PermissionController::class, "updatePermission"])->name('permission.update');
    Route::get('/{user_id}/userPermission', [PermissionController::class, "userPermission"])->name('permission.list.userPermission');
});

Route::prefix('myleave')->group(function () {
    Route::get('/', [LeaveDataController::class, "leaveIndex"])->name('myleave.index');
    Route::get('/myleaveData', [LeaveDataController::class, "leaveData"])->name('myleave.all');
    Route::post('/myleaveStore', [LeaveDataController::class, "myleaveStore"])->name('myleave.store');
    Route::delete('/{leave_id}/myleaveDelete', [LeaveDataController::class, "leaveDelete"])->name('myleave.delete');
});

Route::prefix('allleave')->group(function () {
    Route::get('/', [LeaveDataController::class, "leaveIndex"])->name('allleave.index');
    Route::get('/allleaveData', [LeaveDataController::class, "leaveData"])->name('allleave.all');
    Route::delete('/{leave_id}/allleaveDelete', [LeaveDataController::class, "leaveDelete"])->name('allleave.delete');
    Route::get('/{leave_id}/acceptLeave', [LeaveDataController::class, "acceptLeave"])->name('allleave.acceptLeave');
    Route::get('/{leave_id}/rejectLeave', [LeaveDataController::class, "rejectLeave"])->name('allleave.rejectLeave');
});
