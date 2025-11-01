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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Debug: Check if admin exists
        $admin = Admin::where('email', $credentials['email'])->first();
        if (!$admin) {
            return back()->withErrors([
                'email' => 'No admin found with this email.',
            ]);
        }

        // Debug: Check password
        if (!password_verify($credentials['password'], $admin->password)) {
            return back()->withErrors([
                'email' => 'Invalid password.',
            ]);
        }

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

        return back()->withErrors([
            'email' => 'Authentication failed.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
