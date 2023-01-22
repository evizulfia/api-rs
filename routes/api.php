<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth-login', [UserController::class, 'login']);


Route::get('/dokter', [DokterController::class, 'index']);
Route::post('/dokter-store', [DokterController::class, 'store']);
Route::post('/dokter-update/{id}', [DokterController::class, 'update']);
Route::delete('/dokter-destroy/{id}', [DokterController::class, 'destroy']);
Route::get('/dokter-search', [DokterController::class, 'search']);
