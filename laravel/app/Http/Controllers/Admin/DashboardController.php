<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Models\SocialShareClick;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index(Request $request)
    {
        try {
            // Get date range from request, default to 7 days (only 7 or 30 allowed)
            $dateRange = $request->input('range', '7');
            if (!in_array($dateRange, ['7', '30'])) {
                $dateRange = '7';
            }
            
            // Date ranges
        $now = Carbon::now()->endOfDay();
        $startDate = $this->getStartDate($dateRange, $now);
        $last30Days = $now->copy()->subDays(30);
        $previous30Days = $last30Days->copy()->subDays(30);
        $lastMonth = $now->copy()->subMonth();
        $previousMonth = $lastMonth->copy()->subMonth();
        $last7Days = $now->copy()->subDays(7);
        $previous7Days = $last7Days->copy()->subDays(7);
        // Calculate metrics from database
        // Unique Visitors - Count distinct IP addresses (based on selected range)
        $currentUniqueVisitors = Visit::whereBetween('created_at', [$startDate, $now])
            ->selectRaw('COUNT(DISTINCT ip_address) as count')
            ->value('count') ?? 0;
        $previousUniqueVisitors = Visit::whereBetween('created_at', [$previousMonth, $lastMonth])
            ->selectRaw('COUNT(DISTINCT ip_address) as count')
            ->value('count') ?? 0;
        $uniqueVisitorsChange = $previousUniqueVisitors > 0 
            ? (($currentUniqueVisitors - $previousUniqueVisitors) / $previousUniqueVisitors) * 100 
            : 0;

        // Device Types count - Count distinct device types
        $deviceTypesCount = Visit::whereNotNull('device_type')
            ->selectRaw('COUNT(DISTINCT device_type) as count')
            ->value('count') ?? 0;

        // Total Shares (based on selected range)
        $currentShares = SocialShareClick::whereBetween('created_at', [$startDate, $now])->count();
        $previousShares = SocialShareClick::whereBetween('created_at', [$previousMonth, $lastMonth])->count();
        $sharesChange = $previousShares > 0 
            ? (($currentShares - $previousShares) / $previousShares) * 100 
            : 0;

        // Total Articles
        $currentArticles = Article::where('is_published', true)->count();
        $previousArticles = Article::where('is_published', true)
            ->where('created_at', '<', $lastMonth)
            ->count();
        $articlesChange = $previousArticles > 0 
            ? (($currentArticles - $previousArticles) / $previousArticles) * 100 
            : 0;

        $metrics = [
            'unique_visitors' => [
                'value' => $currentUniqueVisitors,
                'change' => abs($uniqueVisitorsChange),
                'is_positive' => $uniqueVisitorsChange >= 0,
            ],
            'device_types' => [
                'value' => $deviceTypesCount,
                'change' => 0.0,
                'is_positive' => true,
            ],
            'total_shares' => [
                'value' => $currentShares,
                'change' => abs($sharesChange),
                'is_positive' => $sharesChange >= 0,
            ],
            'total_articles' => [
                'value' => $currentArticles,
                'change' => abs($articlesChange),
                'is_positive' => $articlesChange >= 0,
            ],
        ];

        // Shares Trend - Group by day (based on selected range)
        $sharesByDay = SocialShareClick::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('created_at', [$startDate, $now])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Generate labels and values based on date range (7 or 30 days only)
        $labels = [];
        $values = [];
        $daysDiff = $startDate->diffInDays($now);
        
        // For 7 or 30 days, show daily data
        $dayCount = 0;
        $step = $daysDiff <= 7 ? 1 : 2;
        
        foreach ($sharesByDay as $day) {
            $dayCount++;
            if ($dayCount % $step == 1 || $dayCount == $sharesByDay->count()) {
                $labels[] = Carbon::parse($day->date)->format('M d');
                $values[] = $day->count;
            }
        }
        
        // If no data, show placeholder
        if (empty($labels)) {
            $placeholderDays = $daysDiff <= 7 ? 7 : 30;
            $labels = [];
            $values = [];
            for ($i = 0; $i < $placeholderDays; $i += $step) {
                $labels[] = 'Day ' . ($i + 1);
                $values[] = 0;
            }
        }

        $totalShares = SocialShareClick::whereBetween('created_at', [$startDate, $now])->count();
        $avgDaily = $daysDiff > 0 ? round($totalShares / $daysDiff, 0) : 0;

        $sharesTrendData = [
            'labels' => $labels,
            'values' => $values,
            'total_shares' => $totalShares,
            'avg_daily' => $avgDaily,
        ];

        // Top Categories Shared (based on selected range)
        $categorySharesQuery = SocialShareClick::join('articles', 'socialdata.article_id', '=', 'articles.id')
            ->select('articles.category', DB::raw('COUNT(*) as shares'))
            ->whereNotNull('socialdata.article_id')
            ->whereBetween('socialdata.created_at', [$startDate, $now]);
        
        $categoryShares = $categorySharesQuery
            ->groupBy('articles.category')
            ->orderBy('shares', 'desc')
            ->limit(5)
            ->get();

        $totalCategoryShares = $categoryShares->sum('shares');
        
        $categoryColors = [
            'tech' => 'bg-blue-500',
            'politics' => 'bg-red-500',
            'business' => 'bg-green-500',
            'sports' => 'bg-orange-500',
            'health' => 'bg-purple-500',
            'economy' => 'bg-yellow-500',
            'nation' => 'bg-indigo-500',
            'world' => 'bg-cyan-500',
        ];

        $categoryIcons = [
            'tech' => 'fa-microchip',
            'politics' => 'fa-landmark',
            'business' => 'fa-briefcase',
            'sports' => 'fa-futbol',
            'health' => 'fa-heartbeat',
            'economy' => 'fa-chart-line',
            'nation' => 'fa-flag',
            'world' => 'fa-globe',
        ];

        $topCategoriesShared = $categoryShares->map(function ($item) use ($totalCategoryShares, $categoryColors, $categoryIcons) {
            $category = $item->category;
            $percentage = $totalCategoryShares > 0 ? ($item->shares / $totalCategoryShares) * 100 : 0;
            
            return [
                'name' => ucfirst($category),
                'description' => ucfirst($category) . ' News',
                'shares' => $item->shares,
                'percentage' => $percentage,
                'color' => $categoryColors[$category] ?? 'bg-gray-500',
                'icon' => $categoryIcons[$category] ?? 'fa-newspaper'
            ];
        })->toArray();

        // If no categories, use empty array
        if (empty($topCategoriesShared)) {
            $topCategoriesShared = [];
        }

        // Daily Shares (for mini chart in Shares card - based on selected range)
        $dailyShares = SocialShareClick::select(
                DB::raw('DAYOFWEEK(created_at) as day'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('created_at', [$startDate, $now])
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // Map day of week (1=Sunday, 2=Monday, etc.) to labels
        $dayLabels = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
        $dayValues = array_fill(0, 7, 0);
        
        foreach ($dailyShares as $day) {
            // Convert to 0-based index (0=Sunday, 1=Monday, etc.)
            $index = ($day->day - 1) % 7;
            $dayValues[$index] = $day->count;
        }

        $dailySharesData = [
            'labels' => $dayLabels,
            'values' => $dayValues,
        ];

        // Shares by Platform (for donut chart - based on selected range)
        $platformShares = SocialShareClick::select('platform', DB::raw('COUNT(*) as shares'))
            ->whereBetween('created_at', [$startDate, $now])
            ->groupBy('platform')
            ->orderBy('shares', 'desc')
            ->get();

        $platformMap = [
            'whatsapp' => ['label' => 'WhatsApp', 'color' => 'rgba(34, 197, 94, 1)'],
            'telegram' => ['label' => 'Telegram', 'color' => 'rgba(14, 165, 233, 1)'], // Changed to cyan to be more distinct from Facebook
            'twitter' => ['label' => 'X', 'color' => 'rgba(96, 165, 250, 1)'], // Lighter blue for better dark mode visibility
            'x' => ['label' => 'X', 'color' => 'rgba(96, 165, 250, 1)'], // Handle both 'x' and 'twitter'
            'facebook' => ['label' => 'Facebook', 'color' => 'rgba(37, 99, 235, 1)'],
            'email' => ['label' => 'Mail', 'color' => 'rgba(249, 115, 22, 1)'],
        ];

        $labels = [];
        $values = [];
        $colors = [];

        foreach ($platformShares as $platform) {
            if (isset($platformMap[$platform->platform])) {
                $labels[] = $platformMap[$platform->platform]['label'];
                $values[] = $platform->shares;
                $colors[] = $platformMap[$platform->platform]['color'];
            }
        }

        // Ensure we have data, otherwise use defaults
        if (empty($labels)) {
            $labels = ['WhatsApp', 'Telegram', 'X', 'Facebook', 'Mail'];
            $values = [0, 0, 0, 0, 0];
            $colors = [
                'rgba(34, 197, 94, 1)',
                'rgba(14, 165, 233, 1)', // Changed to cyan for Telegram
                'rgba(96, 165, 250, 1)', // Lighter blue for X platform
                'rgba(37, 99, 235, 1)',
                'rgba(249, 115, 22, 1)',
            ];
        }

        $sharesByPlatform = [
            'labels' => $labels,
            'values' => $values,
            'colors' => $colors,
        ];

        // Daily Visitors (for mini chart in Visitors card - based on selected range)
        $dailyVisitors = Visit::select(
                DB::raw('DAYOFWEEK(created_at) as day'),
                DB::raw('COUNT(DISTINCT ip_address) as count')
            )
            ->whereBetween('created_at', [$startDate, $now])
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $visitorDayLabels = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
        $visitorDayValues = array_fill(0, 7, 0);
        
        foreach ($dailyVisitors as $day) {
            $index = ($day->day - 1) % 7;
            $visitorDayValues[$index] = $day->count;
        }

        $dailyVisitorsData = [
            'labels' => $visitorDayLabels,
            'values' => $visitorDayValues,
        ];

        // Device Types (from visits - based on selected range)
        $deviceBreakdown = Visit::select('device_type', DB::raw('COUNT(*) as count'))
            ->whereNotNull('device_type')
            ->whereBetween('created_at', [$startDate, $now])
            ->groupBy('device_type')
            ->orderBy('count', 'desc')
            ->get();

        $totalDeviceVisits = $deviceBreakdown->sum('count');

        $deviceTypeMap = [
            'desktop' => ['name' => 'Desktop', 'description' => 'Windows & Mac', 'color' => 'bg-blue-500', 'icon' => 'fa-desktop'],
            'mobile' => ['name' => 'Mobile', 'description' => 'Smartphones', 'color' => 'bg-green-500', 'icon' => 'fa-mobile-alt'],
            'tablet' => ['name' => 'Tablet', 'description' => 'iPad & Android', 'color' => 'bg-purple-500', 'icon' => 'fa-tablet-alt'],
        ];

        $deviceTypes = $deviceBreakdown->map(function ($item) use ($totalDeviceVisits, $deviceTypeMap) {
            $deviceType = strtolower($item->device_type);
            $percentage = $totalDeviceVisits > 0 ? ($item->count / $totalDeviceVisits) * 100 : 0;
            
            $mapped = $deviceTypeMap[$deviceType] ?? [
                'name' => ucfirst($item->device_type),
                'description' => ucfirst($item->device_type),
                'color' => 'bg-gray-500',
                'icon' => 'fa-desktop'
            ];
            
            return [
                'name' => $mapped['name'],
                'description' => $mapped['description'],
                'count' => $item->count,
                'percentage' => $percentage,
                'color' => $mapped['color'],
                'icon' => $mapped['icon']
            ];
        })->toArray();

        // If no device types, use empty array
        if (empty($deviceTypes)) {
            $deviceTypes = [];
        }

        $response = response()->view('admin.dashboard', compact('metrics', 'sharesTrendData', 'topCategoriesShared', 'dailySharesData', 'dailyVisitorsData', 'deviceTypes', 'sharesByPlatform', 'dateRange'));
        
        // Add cache control headers to prevent back button from showing cached dashboard
        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');
        
        return $response;
        } catch (\Exception $e) {
            \Log::error('Dashboard error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->route('admin.login')
                ->with('error', 'An error occurred while loading the dashboard. Please try again.')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        }
    }

    /**
     * Export Shares Trend to Excel
     */
    public function exportSharesTrend()
    {
        try {
        $now = Carbon::now();
        $last30Days = $now->copy()->subDays(30);
        
        $sharesByDay = SocialShareClick::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('created_at', [$last30Days, $now])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $filename = 'shares_trend_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($sharesByDay) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Date', 'Shares']);
            
            foreach ($sharesByDay as $day) {
                fputcsv($file, [
                    Carbon::parse($day->date)->format('Y-m-d'),
                    $day->count
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            \Log::error('Export shares trend error: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')
                ->with('error', 'Failed to export shares trend data.');
        }
    }

    /**
     * Export Top Categories to Excel
     */
    public function exportTopCategories()
    {
        try {
        $categoryShares = SocialShareClick::join('articles', 'socialdata.article_id', '=', 'articles.id')
            ->select('articles.category', DB::raw('COUNT(*) as shares'))
            ->whereNotNull('socialdata.article_id')
            ->groupBy('articles.category')
            ->orderBy('shares', 'desc')
            ->limit(5)
            ->get();

        $totalCategoryShares = $categoryShares->sum('shares');

        $filename = 'top_categories_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($categoryShares, $totalCategoryShares) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Category', 'Shares', 'Percentage']);
            
            foreach ($categoryShares as $item) {
                $percentage = $totalCategoryShares > 0 ? ($item->shares / $totalCategoryShares) * 100 : 0;
                fputcsv($file, [
                    ucfirst($item->category),
                    $item->shares,
                    number_format($percentage, 2) . '%'
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            \Log::error('Export top categories error: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')
                ->with('error', 'Failed to export top categories data.');
        }
    }

    /**
     * Export Shares by Platform to Excel
     */
    public function exportSharesByPlatform()
    {
        try {
        $platformShares = SocialShareClick::select('platform', DB::raw('COUNT(*) as shares'))
            ->groupBy('platform')
            ->orderBy('shares', 'desc')
            ->get();

        $platformMap = [
            'whatsapp' => 'WhatsApp',
            'telegram' => 'Telegram',
            'twitter' => 'X',
            'x' => 'X',
            'facebook' => 'Facebook',
            'email' => 'Mail',
        ];

        $filename = 'shares_by_platform_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($platformShares, $platformMap) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Platform', 'Shares']);
            
            foreach ($platformShares as $platform) {
                $label = $platformMap[$platform->platform] ?? ucfirst($platform->platform);
                fputcsv($file, [$label, $platform->shares]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            \Log::error('Export shares by platform error: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')
                ->with('error', 'Failed to export shares by platform data.');
        }
    }

    /**
     * Export Daily Visitors to Excel
     */
    public function exportDailyVisitors()
    {
        try {
        $now = Carbon::now();
        $last7Days = $now->copy()->subDays(7);
        
        $dailyVisitors = Visit::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(DISTINCT ip_address) as unique_visitors'),
                DB::raw('COUNT(*) as total_visits')
            )
            ->whereBetween('created_at', [$last7Days, $now])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $filename = 'daily_visitors_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($dailyVisitors) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Date', 'Unique Visitors', 'Total Visits']);
            
            foreach ($dailyVisitors as $day) {
                fputcsv($file, [
                    Carbon::parse($day->date)->format('Y-m-d'),
                    $day->unique_visitors,
                    $day->total_visits
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            \Log::error('Export daily visitors error: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')
                ->with('error', 'Failed to export daily visitors data.');
        }
    }

    /**
     * Export Device Types to Excel
     */
    public function exportDeviceTypes()
    {
        try {
        $deviceBreakdown = Visit::select('device_type', DB::raw('COUNT(*) as count'))
            ->whereNotNull('device_type')
            ->groupBy('device_type')
            ->orderBy('count', 'desc')
            ->get();

        $totalDeviceVisits = $deviceBreakdown->sum('count');

        $filename = 'device_types_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($deviceBreakdown, $totalDeviceVisits) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Device Type', 'Visits', 'Percentage']);
            
            foreach ($deviceBreakdown as $item) {
                $percentage = $totalDeviceVisits > 0 ? ($item->count / $totalDeviceVisits) * 100 : 0;
                fputcsv($file, [
                    ucfirst($item->device_type),
                    $item->count,
                    number_format($percentage, 2) . '%'
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            \Log::error('Export device types error: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')
                ->with('error', 'Failed to export device types data.');
        }
    }

    /**
     * Get chart data via AJAX based on date range
     */
    public function getChartData(Request $request)
    {
        try {
            // Only allow 7 or 30 days
            $dateRange = $request->input('range', '7');
            if (!in_array($dateRange, ['7', '30'])) {
                $dateRange = '7';
            }
            $now = Carbon::now()->endOfDay();
            $startDate = $this->getStartDate($dateRange, $now);
            
            // Shares Trend
            $sharesByDay = SocialShareClick::select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('COUNT(*) as count')
                )
                ->whereBetween('created_at', [$startDate, $now])
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            $labels = [];
            $values = [];
            $daysDiff = $startDate->diffInDays($now);
            
            // For 7 or 30 days, show daily data
            $dayCount = 0;
            $step = $daysDiff <= 7 ? 1 : 2;
            
            foreach ($sharesByDay as $day) {
                $dayCount++;
                if ($dayCount % $step == 1 || $dayCount == $sharesByDay->count()) {
                    $labels[] = Carbon::parse($day->date)->format('M d');
                    $values[] = $day->count;
                }
            }

            $totalShares = SocialShareClick::whereBetween('created_at', [$startDate, $now])->count();
            $avgDaily = $daysDiff > 0 ? round($totalShares / $daysDiff, 0) : 0;

            // Shares by Platform
            $platformShares = SocialShareClick::select('platform', DB::raw('COUNT(*) as shares'))
                ->whereBetween('created_at', [$startDate, $now])
                ->groupBy('platform')
                ->orderBy('shares', 'desc')
                ->get();

            $platformMap = [
                'whatsapp' => ['label' => 'WhatsApp', 'color' => 'rgba(34, 197, 94, 1)'],
                'telegram' => ['label' => 'Telegram', 'color' => 'rgba(14, 165, 233, 1)'],
                'twitter' => ['label' => 'X', 'color' => 'rgba(96, 165, 250, 1)'],
                'x' => ['label' => 'X', 'color' => 'rgba(96, 165, 250, 1)'],
                'facebook' => ['label' => 'Facebook', 'color' => 'rgba(37, 99, 235, 1)'],
                'email' => ['label' => 'Mail', 'color' => 'rgba(249, 115, 22, 1)'],
            ];

            $platformLabels = [];
            $platformValues = [];
            $platformColors = [];

            foreach ($platformShares as $platform) {
                if (isset($platformMap[$platform->platform])) {
                    $platformLabels[] = $platformMap[$platform->platform]['label'];
                    $platformValues[] = $platform->shares;
                    $platformColors[] = $platformMap[$platform->platform]['color'];
                }
            }

            // Daily Visitors
            $visitors = Visit::select(
                    DB::raw('DAYOFWEEK(created_at) as day'),
                    DB::raw('COUNT(DISTINCT ip_address) as count')
                )
                ->whereBetween('created_at', [$startDate, $now])
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            $visitorDayLabels = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
            $visitorDayValues = array_fill(0, 7, 0);
            
            foreach ($visitors as $day) {
                $index = ($day->day - 1) % 7;
                $visitorDayValues[$index] = $day->count;
            }

            $dailyVisitors = [
                'labels' => $visitorDayLabels,
                'values' => $visitorDayValues,
            ];

            // Top Categories
            $categoryShares = SocialShareClick::join('articles', 'socialdata.article_id', '=', 'articles.id')
                ->select('articles.category', DB::raw('COUNT(*) as shares'))
                ->whereNotNull('socialdata.article_id')
                ->whereBetween('socialdata.created_at', [$startDate, $now])
                ->groupBy('articles.category')
                ->orderBy('shares', 'desc')
                ->limit(5)
                ->get();

            $categoryColors = [
                'tech' => 'bg-blue-500',
                'politics' => 'bg-red-500',
                'business' => 'bg-green-500',
                'sports' => 'bg-orange-500',
                'health' => 'bg-purple-500',
                'economy' => 'bg-yellow-500',
                'nation' => 'bg-indigo-500',
                'world' => 'bg-cyan-500',
            ];

            $categoryIcons = [
                'tech' => 'fa-microchip',
                'politics' => 'fa-landmark',
                'business' => 'fa-briefcase',
                'sports' => 'fa-futbol',
                'health' => 'fa-heartbeat',
                'economy' => 'fa-chart-line',
                'nation' => 'fa-flag',
                'world' => 'fa-globe',
            ];

            $topCategories = $categoryShares->map(function ($item) use ($categoryColors, $categoryIcons) {
                $category = $item->category;
                return [
                    'name' => ucfirst($category),
                    'description' => ucfirst($category) . ' News',
                    'shares' => $item->shares,
                    'color' => $categoryColors[$category] ?? 'bg-gray-500',
                    'icon' => $categoryIcons[$category] ?? 'fa-newspaper'
                ];
            })->toArray();

            // Device Types
            $deviceBreakdown = Visit::select('device_type', DB::raw('COUNT(*) as count'))
                ->whereNotNull('device_type')
                ->whereBetween('created_at', [$startDate, $now])
                ->groupBy('device_type')
                ->orderBy('count', 'desc')
                ->get();

            $deviceTypeMap = [
                'desktop' => ['name' => 'Desktop', 'description' => 'Windows & Mac', 'color' => 'bg-blue-500', 'icon' => 'fa-desktop'],
                'mobile' => ['name' => 'Mobile', 'description' => 'Smartphones', 'color' => 'bg-green-500', 'icon' => 'fa-mobile-alt'],
                'tablet' => ['name' => 'Tablet', 'description' => 'iPad & Android', 'color' => 'bg-purple-500', 'icon' => 'fa-tablet-alt'],
            ];

            $deviceTypes = $deviceBreakdown->map(function ($item) use ($deviceTypeMap) {
                $deviceType = strtolower($item->device_type);
                $mapped = $deviceTypeMap[$deviceType] ?? [
                    'name' => ucfirst($item->device_type),
                    'description' => ucfirst($item->device_type),
                    'color' => 'bg-gray-500',
                    'icon' => 'fa-desktop'
                ];
                
                return [
                    'name' => $mapped['name'],
                    'description' => $mapped['description'],
                    'count' => $item->count,
                    'color' => $mapped['color'],
                    'icon' => $mapped['icon']
                ];
            })->toArray();

            // Metrics
            $uniqueVisitors = Visit::whereBetween('created_at', [$startDate, $now])
                ->selectRaw('COUNT(DISTINCT ip_address) as count')
                ->value('count') ?? 0;

            $totalShares = SocialShareClick::whereBetween('created_at', [$startDate, $now])->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'sharesTrend' => [
                        'labels' => $labels,
                        'values' => $values,
                        'total_shares' => $totalShares,
                        'avg_daily' => $avgDaily,
                    ],
                    'sharesByPlatform' => [
                        'labels' => $platformLabels,
                        'values' => $platformValues,
                        'colors' => $platformColors,
                    ],
                    'dailyVisitors' => $dailyVisitors,
                    'topCategories' => $topCategories,
                    'deviceTypes' => $deviceTypes,
                    'metrics' => [
                        'unique_visitors' => $uniqueVisitors,
                        'total_shares' => $totalShares,
                    ],
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Get chart data error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch chart data.'
            ], 500);
        }
    }

    /**
     * Get start date based on range (only 7 or 30 days)
     */
    private function getStartDate($range, $now)
    {
        switch ($range) {
            case '30':
                // Start from 30 days ago at the beginning of that day
                return $now->copy()->subDays(30)->startOfDay();
            case '7':
            default:
                // Start from 7 days ago at the beginning of that day (default)
                return $now->copy()->subDays(7)->startOfDay();
        }
    }
}

