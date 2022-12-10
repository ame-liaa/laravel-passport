<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function DefaultUnauthenticated()
    {
        return response()->json([
            'status' => 'failed',
            'message' => 'unauthenticated',
            'data' => null
        ]);
    }

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        $token = $user->createToken('device 1')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'success login',
            'data' => [
                'email' => $user->email,
                'token' => $token
            ]
        ]);
    }

    public function Logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'success logout',
            'data' => null
        ]);
    }
}
