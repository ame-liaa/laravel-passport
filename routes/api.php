<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Doctor;

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

Route::get('/doctors', function (Request $request) {
    $doctors = Doctor::get();

    return response()->json([
        'status' => 'success',
        'message' => 'success get doctor',
        'data' => $doctors
    ]);
});

Route::post('/doctors', function (Request $request) {
    $newDoctor = Doctor::create([
        'name' => $request->name, 
        'specialities' => $request->specialities
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'success get doctor',
        'data' => $newDoctor
    ]);
});

Route::get('/doctors/{uniqueId}', function (Request $request, $uniqueId) {
    $existedDoctor = Doctor::where('id', $uniqueId)->first();
    if ($existedDoctor == null) {

        return response()->json([
            'status' => 'failed',
            'message' => 'doctor not found'
        ], 404);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'success get doctor',
        'data' => $existedDoctor
    ]);
});

Route::put('doctors/{uniqueId}', function (Request $request, $uniqueId) {
    $existedDoctor = Doctor::where('id', $uniqueId)->first();
    if ($existedDoctor == null) {

        return response()->json([
            'status' => 'failed',
            'message' => 'doctor not found'
        ], 404);
    }

    $existedDoctor->name = $request->name;
    $existedDoctor->specialities = $request->specialities;

    $existedDoctor->save();

    return response()->json([
        'status' => 'success',
        'message' => 'success get doctor',
        'data' => $existedDoctor
    ]);
});

Route::delete('doctors/{uniqueId}', function (Request $request, $uniqueId) {
    $existedDoctor = Doctor::where('id', $uniqueId)->first();
    if ($existedDoctor == null) {

        return response()->json([
            'status' => 'failed',
            'message' => 'doctor not found'
        ], 404);
    }

    $existedDoctor->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'success delete doctor'
    ]);
});

Route::get('/doctors-paginate', function (Request $request) {
    $doctors = Doctor::paginate(3);

    return response()->json([
        'status' => 'success',
        'message' => 'success get doctor',
        'data' => $doctors
    ]);
});