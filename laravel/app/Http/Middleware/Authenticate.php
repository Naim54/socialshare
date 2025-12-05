<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // If the request expects a JSON response, return null (will return 401)
        if ($request->expectsJson()) {
            return null;
        }

        // Check if this is an admin route or if admin guard is being used
        // The guards are available through the parent class's $guards property
        $guards = $this->guards;
        
        // If admin guard is specified or we're on an admin route, redirect to admin.login
        if (in_array('admin', $guards) || empty($guards) || $request->is('admin/*')) {
            return route('admin.login');
        }

        // Default redirect to admin.login for this application
        return route('admin.login');
    }
}

