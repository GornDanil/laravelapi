<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\DepartmentsController;
use App\Http\Controllers\Api\WorkersController;
use App\Http\Controllers\Api\ResetPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('auth')->group(function () {
    Route::post('/registration', [AuthenticationController::class, 'registration'])->name('registration');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('reset-password');
});


Route::middleware('auth:sanctum')->group(function() {
    Route::get('departments', [DepartmentsController::class, 'departments']);
    Route::get('auth:sanctum')->get('workers', [WorkersController::class, 'workersList']);
    Route::get('auth:sanctum')->get('workers/{user}', [WorkersController::class, 'userWorker']);
    Route::get('auth:sanctum')->get('user', [WorkersController::class, 'user']);
    Route::get('auth:sanctum')->post('user', [WorkersController::class, 'updateUser']);
});



