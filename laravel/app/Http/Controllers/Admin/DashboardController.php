<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Models\SocialShareClick;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index()
    {
        // Date ranges
        $now = Carbon::now();
        $last30Days = $now->copy()->subDays(30);
        $previous30Days = $last30Days->copy()->subDays(30);
        $lastMonth = $now->copy()->subMonth();
        $previousMonth = $lastMonth->copy()->subMonth();
        $last7Days = $now->copy()->subDays(7);
        $previous7Days = $last7Days->copy()->subDays(7);
        // Calculate metrics from database
        // Unique Visitors - Count distinct IP addresses
        $currentUniqueVisitors = Visit::whereBetween('created_at', [$lastMonth, $now])
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

        // Total Shares
        $currentShares = SocialShareClick::whereBetween('created_at', [$lastMonth, $now])->count();
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

        // Shares Trend (Last 30 Days) - Group by day
        $sharesByDay = SocialShareClick::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('created_at', [$last30Days, $now])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Generate labels and values (showing every 5 days for cleaner display)
        $labels = [];
        $values = [];
        $dayCount = 0;
        foreach ($sharesByDay as $day) {
            $dayCount++;
            if ($dayCount % 5 == 1 || $dayCount == $sharesByDay->count()) {
                $labels[] = Carbon::parse($day->date)->format('M d');
                $values[] = $day->count;
            }
        }

        // If no data, show placeholder
        if (empty($labels)) {
            $labels = ['Day 1', 'Day 5', 'Day 10', 'Day 15', 'Day 20', 'Day 25', 'Day 30'];
            $values = [0, 0, 0, 0, 0, 0, 0];
        }

        $totalShares30Days = SocialShareClick::whereBetween('created_at', [$last30Days, $now])->count();
        $avgDaily = $totalShares30Days > 0 ? round($totalShares30Days / 30, 0) : 0;

        $sharesTrendData = [
            'labels' => $labels,
            'values' => $values,
            'total_shares' => $totalShares30Days,
            'avg_daily' => $avgDaily,
        ];

        // Top Categories Shared
        $categoryShares = SocialShareClick::join('articles', 'socialdata.article_id', '=', 'articles.id')
            ->select('articles.category', DB::raw('COUNT(*) as shares'))
            ->whereNotNull('socialdata.article_id')
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

        // Daily Shares (Last 7 days - for mini chart in Shares card)
        $dailyShares = SocialShareClick::select(
                DB::raw('DAYOFWEEK(created_at) as day'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('created_at', [$last7Days, $now])
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

        // Shares by Platform (for donut chart)
        $platformShares = SocialShareClick::select('platform', DB::raw('COUNT(*) as shares'))
            ->groupBy('platform')
            ->orderBy('shares', 'desc')
            ->get();

        $platformMap = [
            'whatsapp' => ['label' => 'WhatsApp', 'color' => 'rgba(34, 197, 94, 1)'],
            'telegram' => ['label' => 'Telegram', 'color' => 'rgba(59, 130, 246, 1)'],
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
                'rgba(59, 130, 246, 1)',
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

        // Daily Visitors (Last 7 days - for mini chart in Visitors card)
        $dailyVisitors = Visit::select(
                DB::raw('DAYOFWEEK(created_at) as day'),
                DB::raw('COUNT(DISTINCT ip_address) as count')
            )
            ->whereBetween('created_at', [$last7Days, $now])
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

        // Device Types (from visits)
        $deviceBreakdown = Visit::select('device_type', DB::raw('COUNT(*) as count'))
            ->whereNotNull('device_type')
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

        return view('admin.dashboard', compact('metrics', 'sharesTrendData', 'topCategoriesShared', 'dailySharesData', 'dailyVisitorsData', 'deviceTypes', 'sharesByPlatform'));
    }

    /**
     * Export Shares Trend to Excel
     */
    public function exportSharesTrend()
    {
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
    }

    /**
     * Export Top Categories to Excel
     */
    public function exportTopCategories()
    {
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
    }

    /**
     * Export Shares by Platform to Excel
     */
    public function exportSharesByPlatform()
    {
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
    }

    /**
     * Export Daily Visitors to Excel
     */
    public function exportDailyVisitors()
    {
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
    }

    /**
     * Export Device Types to Excel
     */
    public function exportDeviceTypes()
    {
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
    }
}

