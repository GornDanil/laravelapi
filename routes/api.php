<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\DepartmentsController;
use App\Http\Controllers\Api\WorkersController;
use App\Http\Controllers\Api\ResetPasswordController;
use Illuminate\Support\Facades\Route;

/*
|------middleware' = > 'throttle:3'--------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('auth')->group(function () {
    Route::post('/registration', [AuthenticationController::class, 'registration'])
        ->middleware('throttle:20,1')->name('registration');

    Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

    Route::post('/restore', [ResetPasswordController::class, 'forgotPassword'])->name('restore');

    Route::post('restore/confirm', [ResetPasswordController::class, 'reset'])->name('confirm');
});


Route::middleware('auth:sanctum')->group(function() {
    Route::get('departments', [DepartmentsController::class, 'departments']);

    Route::get('workers', [WorkersController::class, 'workersList']);

    Route::get('workers/{user}', [WorkersController::class, 'userWorker']);

    Route::get('user', [WorkersController::class, 'user']);

    Route::post('user', [WorkersController::class, 'updateUser']);
});



