<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login and generate API token
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'name' => 'nullable|string|max:255', // Optional client name
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Generate API token
        $token = ApiToken::generate();
        $tokenName = $request->input('name', 'API Client - ' . now()->toDateTimeString());

        // Create token record
        $apiToken = ApiToken::create([
            'token' => $token,
            'name' => $tokenName,
            'admin_id' => $admin->id,
            'expires_at' => now()->addMonths(3), // Token expires in 3 months
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $apiToken->expires_at->toDateTimeString(),
                'admin' => [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'email' => $admin->email,
                ],
            ],
        ], 200);
    }

    /**
     * Logout and revoke token
     */
    public function logout(Request $request)
    {
        $token = $request->header('Authorization');
        
        if ($token) {
            // Remove "Bearer " prefix if present
            $token = str_replace('Bearer ', '', $token);
            
            $apiToken = ApiToken::where('token', $token)->first();
            
            if ($apiToken) {
                $apiToken->update(['is_active' => false]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ], 200);
    }
}

