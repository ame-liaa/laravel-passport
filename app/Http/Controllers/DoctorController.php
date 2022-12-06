<?php

namespace App\Http\Controllers;
use App\Models\Doctor;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function ListDoctor (Request $request)
    {
        $doctors = Doctor::get();

        return response()->json([
            'status' => 'success',
            'message' => 'success get list doctor',
            'data' => $doctors
        ]);
    }

    public function PostDoctor (Request $request)
    {
        $newDoctor = Doctor::create([
            'name' => $request->name, 
            'specialities' => $request->specialities
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'success post doctor',
            'data' => $newDoctor
        ]);
    }

    public function DetailDoctor (Request $request, int $uniqueId)
    {
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
    }

    public function UpdateDoctor (Request $request, int $uniqueId)
    {
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
            'message' => 'success update doctor',
            'data' => $existedDoctor
        ]);
    }

    public function DeleteDoctor (Request $request, int $uniqueId)
    {
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
    }

    public function ListDoctorPaginate (Request $request)
    {
        $doctors = Doctor::paginate(3);

        return response()->json([
            'status' => 'success',
            'message' => 'success get doctor with pagination',
            'data' => $doctors
        ]);
    }
}
