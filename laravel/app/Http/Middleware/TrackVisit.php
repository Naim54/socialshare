<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track GET requests (not POST, PUT, DELETE, etc.)
        if ($request->isMethod('GET')) {
            // Skip tracking for admin routes, API routes, and health check routes
            if (!$request->is('admin/*') && 
                !$request->is('api/*') && 
                !$request->is('up') &&
                !$request->ajax()) { // Skip AJAX requests to avoid double tracking
                $this->recordVisit($request);
            }
        }

        return $next($request);
    }

    /**
     * Record a visit
     */
    protected function recordVisit(Request $request): void
    {
        try {
            $ip = $request->ip();
            $userAgent = $request->userAgent();
            $url = $request->fullUrl();
            $referrer = $request->header('referer');
            
            // Extract article ID from URL if it's an article page
            $articleId = null;
            if ($request->routeIs('article.show') && $request->route('slug')) {
                $article = \App\Models\Article::where('slug', $request->route('slug'))->first();
                $articleId = $article ? $article->id : null;
            }

            // Parse user agent for device and browser info
            $deviceInfo = $this->parseUserAgent($userAgent);

            Visit::create([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'url' => $url,
                'referrer' => $referrer,
                'article_id' => $articleId,
                'device_type' => $deviceInfo['device_type'],
                'browser' => $deviceInfo['browser'],
                'os' => $deviceInfo['os'],
            ]);
        } catch (\Exception $e) {
            // Silently fail - don't break the application if tracking fails
            \Log::error('Failed to track visit: ' . $e->getMessage());
        }
    }

    /**
     * Parse user agent to extract device, browser, and OS information
     */
    protected function parseUserAgent(?string $userAgent): array
    {
        if (!$userAgent) {
            return [
                'device_type' => null,
                'browser' => null,
                'os' => null,
            ];
        }

        $deviceType = 'desktop';
        $browser = 'unknown';
        $os = 'unknown';

        // Detect device type
        if (preg_match('/Mobile|Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i', $userAgent)) {
            if (preg_match('/iPad/i', $userAgent)) {
                $deviceType = 'tablet';
            } else {
                $deviceType = 'mobile';
            }
        } elseif (preg_match('/Tablet|iPad/i', $userAgent)) {
            $deviceType = 'tablet';
        }

        // Detect browser
        if (preg_match('/Chrome/i', $userAgent) && !preg_match('/Edg|OPR/i', $userAgent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/Safari/i', $userAgent) && !preg_match('/Chrome/i', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/Edg/i', $userAgent)) {
            $browser = 'Edge';
        } elseif (preg_match('/Opera|OPR/i', $userAgent)) {
            $browser = 'Opera';
        }

        // Detect OS
        if (preg_match('/Windows NT/i', $userAgent)) {
            $os = 'Windows';
        } elseif (preg_match('/Mac OS X/i', $userAgent)) {
            $os = 'macOS';
        } elseif (preg_match('/Linux/i', $userAgent)) {
            $os = 'Linux';
        } elseif (preg_match('/Android/i', $userAgent)) {
            $os = 'Android';
        } elseif (preg_match('/iPhone|iPad|iPod/i', $userAgent)) {
            $os = 'iOS';
        }

        return [
            'device_type' => $deviceType,
            'browser' => $browser,
            'os' => $os,
        ];
    }
}

