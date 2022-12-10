<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Doctor;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LoginController;

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

// Authentication Routes
Route::get('/login', [LoginController::class, 'DefaultUnauthenticated'])->name('login');

Route::post('/login', [LoginController::class, 'Login']);

Route::delete('logout', [LoginController::class, 'Logout'])->middleware('auth:sanctum');

// Resource Routes

Route::get('/doctors', [DoctorController::class, 'ListDoctor']);

Route::get('/doctors/{uniqueId}', [DoctorController::class, 'DetailDoctor']);

Route::put('doctors/{uniqueId}', [DoctorController::class, 'UpdateDoctor']);

Route::delete('doctors/{uniqueId}', [DoctorController::class, 'DeleteDoctor']);

Route::get('/doctors-paginate', [DoctorController::class, 'ListDoctorPaginate']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/doctors', [DoctorController::class, 'PostDoctor']);
});