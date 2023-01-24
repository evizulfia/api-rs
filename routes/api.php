<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\TransactionController;
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

Route::get('/obat', [ObatController::class, 'index']);
Route::post('/obat-store', [ObatController::class, 'store']);
Route::post('/obat-update/{id}', [ObatController::class, 'update']);
Route::delete('/obat-destroy/{id}', [ObatController::class, 'destroy']);
Route::get('/obat-search', [ObatController::class, 'search']);

Route::get('/pasien', [PasienController::class, 'index']);
Route::post('/pasien-store', [PasienController::class, 'store']);
Route::post('/pasien-update/{id}', [PasienController::class, 'update']);
Route::delete('/pasien-destroy/{id}', [PasienController::class, 'destroy']);
Route::get('/pasien-search', [PasienController::class, 'search']);

Route::get('/rekammedis', [RekamMedisController::class, 'index']);
Route::post('/rekammedis-store', [RekamMedisController::class, 'store']);
Route::post('/rekammedis-update/{id}', [RekamMedisController::class, 'update']);
Route::delete('/rekammedis-destroy/{id}', [RekamMedisController::class, 'destroy']);
Route::get('/rekammedis-search', [RekamMedisController::class, 'search']);

Route::get('/laporan', [TransactionController::class, 'index']);
Route::get('/laporan-search', [TransactionController::class, 'search']);


