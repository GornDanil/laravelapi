<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\DepartmentsController;
use App\Http\Controllers\Api\WorkersController;
use Illuminate\Http\Request;
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
Route::post('registration', [AuthenticationController::class, 'registration']);

Route::post('login', [AuthenticationController::class, 'login']);
Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return auth()->user();
});
Route::middleware('auth:sanctum')->get('departments', [DepartmentsController::class, 'departments']);
Route::middleware('auth:sanctum')->get('workers', [WorkersController::class, 'workersList']);
