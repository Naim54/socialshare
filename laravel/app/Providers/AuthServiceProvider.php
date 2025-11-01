<?php

namespace App\Providers;

use App\Models\ApiToken;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Register custom API guard
        Auth::viaRequest('custom', function ($request) {
            $token = $request->header('Authorization');
            
            if (!$token) {
                return null;
            }

            // Remove "Bearer " prefix if present
            $token = str_replace('Bearer ', '', $token);
            
            $apiToken = ApiToken::where('token', $token)
                ->where('is_active', true)
                ->first();
            
            if (!$apiToken || !$apiToken->isValid()) {
                return null;
            }

            // Mark token as used
            $apiToken->markAsUsed();
            
            return $apiToken->admin;
        });
    }
}

