<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            // Use generic error message to prevent email enumeration
            // Always attempt authentication regardless of whether email exists
            if (Auth::guard('admin')->attempt($credentials)) {
                $admin = Auth::guard('admin')->user();

                // Update first login if null
                if (is_null($admin->first_login)) {
                    $admin->first_login = now();
                }

                // Always update last login
                $admin->last_login = now();
                $admin->save();

                return redirect()->route('admin.dashboard');
            }

            // Generic error message for security (doesn't reveal if email exists)
            return back()->withErrors([
                'email' => 'Invalid credentials. Please check your email and password.',
            ])->withInput($request->only('email'));
        } catch (\Exception $e) {
            // Log the error for debugging but show generic message to user
            \Log::error('Admin login error: ' . $e->getMessage());
            
            return back()->withErrors([
                'email' => 'An error occurred during login. Please try again.',
            ])->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        try {
            Auth::guard('admin')->logout();
            
            // Clear session and prevent caching
            $request = request();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            // Add cache control headers to prevent back button from showing cached dashboard
            return redirect()->route('admin.login')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            \Log::error('Admin logout error: ' . $e->getMessage());
            return redirect()->route('admin.login');
        }
    }
}
