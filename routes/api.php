<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Doctor;
use App\Http\Controllers\DoctorController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('login', function() {
    return response()->json([
        'status' => 'failed',
        'message' => 'unauthenticated',
        'data' => null
    ], 401);
})->name('login');

Route::get('/doctors', [DoctorController::class, 'ListDoctor']);

Route::post('/doctors', [DoctorController::class, 'PostDoctor'])->middleware('auth:api');

Route::get('/doctors/{uniqueId}', [DoctorController::class, 'DetailDoctor']);

Route::put('doctors/{uniqueId}', [DoctorController::class, 'UpdateDoctor']);

Route::delete('doctors/{uniqueId}', [DoctorController::class, 'DeleteDoctor']);

Route::get('/doctors-paginate', [DoctorController::class, 'ListDoctorPaginate']);