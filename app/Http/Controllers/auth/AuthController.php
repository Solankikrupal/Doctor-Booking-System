<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function user(Request $request)
    {
        return $request->user();
    }
    public function store(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                //throw an error required input is empty
                throw new ValidationException($validator, response()->json([
                    'message' => $validator->errors(),
                ], 422));
            }

            // Attempt to authenticate the user
            if (Auth::attempt($request->only('email', 'password'))) {

                $user = auth()->user();

                // Ensure user has a valid role
                if (!in_array($user->role, ['doctor', 'patient'])) {
                    Auth::logout();
                    return response()->json([
                        'error' => ['Invalid user role'],
                    ], 404);
                }

                // Generate token
                $token = $user->createToken('auth-token')->plainTextToken;

                // Return response
                $message = ($user->role === 'doctor') ? 'Doctor logged in successfully' : 'Patient logged in successfully';
                return response()->json(['message' => $message, 'token' => $token], 200);
            }

            // Invalid credentials
            return response()->json([
                'error' => ['Invalid credentials'],
            ], 404);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        // Revoke the user's current token
        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
