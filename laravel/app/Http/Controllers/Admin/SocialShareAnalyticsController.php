<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialShareClick;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SocialShareAnalyticsController extends Controller
{
    /**
     * Get social share analytics data with filters
     */
    public function index(Request $request)
    {
        // Get filters
        $platform = $request->input('platform', 'all');
        
        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
        } else {
            // Default to last 30 days
            $startDate = Carbon::now()->subDays(30)->startOfDay();
            $endDate = Carbon::now()->endOfDay();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'total_clicks' => $this->getTotalClicks($startDate, $endDate, $platform),
                'clicks_by_platform' => $this->getClicksByPlatform($startDate, $endDate, $platform),
                'clicks_over_time' => $this->getClicksOverTime($startDate, $endDate, $platform),
                'top_pages' => $this->getTopPages($startDate, $endDate, $platform),
                'platform_stats' => $this->getPlatformStats($startDate, $endDate, $platform),
            ]
        ]);
    }

    /**
     * Get total clicks with filters
     */
    private function getTotalClicks($startDate, $endDate, $platform = 'all')
    {
        $query = DB::table('socialdata')
            ->whereBetween('created_at', [$startDate, $endDate]);
        
        if ($platform !== 'all') {
            $query->where('platform', $platform);
        }
        
        return $query->count();
    }

    /**
     * Get clicks grouped by platform
     */
    private function getClicksByPlatform($startDate, $endDate, $platform = 'all')
    {
        $query = DB::table('socialdata')
            ->select('platform', DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate]);
        
        if ($platform !== 'all') {
            $query->where('platform', $platform);
        }
        
        return $query
            ->groupBy('platform')
            ->orderBy('count', 'desc')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->platform => $item->count];
            });
    }

    /**
     * Get clicks over time (for line/bar charts)
     */
    private function getClicksOverTime($startDate, $endDate, $platform = 'all')
    {
        // Determine grouping based on date range
        $daysDiff = $startDate->diffInDays($endDate);
        
        // Build the raw SQL for grouping
        if ($daysDiff <= 7) {
            // Group by hours
            $groupBySql = 'DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00")';
        } elseif ($daysDiff <= 30) {
            // Group by days
            $groupBySql = 'DATE(created_at)';
        } else {
            // Group by weeks
            $groupBySql = 'YEARWEEK(created_at)';
        }

        $query = DB::table('socialdata')
            ->select(
                DB::raw($groupBySql . ' as period'),
                DB::raw('count(*) as count')
            )
            ->whereBetween('created_at', [$startDate, $endDate]);
        
        if ($platform !== 'all') {
            $query->where('platform', $platform);
        }
        
        $results = $query
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        // Format periods for better display
        return $results->map(function ($item) use ($daysDiff) {
            $period = $item->period;
            $formattedPeriod = $period;
            
            // Format based on grouping type
            if ($daysDiff <= 7) {
                // Format: "Jan 16, 2:00 PM"
                try {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $period . ':00');
                    $formattedPeriod = $date->format('M j, g:i A');
                } catch (\Exception $e) {
                    $formattedPeriod = $period;
                }
            } elseif ($daysDiff <= 30) {
                // Format: "Jan 16, 2025"
                try {
                    $date = Carbon::createFromFormat('Y-m-d', $period);
                    $formattedPeriod = $date->format('M j, Y');
                } catch (\Exception $e) {
                    $formattedPeriod = $period;
                }
            } else {
                // Format: "Week 3, 2025"
                $formattedPeriod = 'Week ' . substr($period, 4) . ', 20' . substr($period, 0, 2);
            }
            
            return [
                'period' => $formattedPeriod,
                'raw_period' => $period,
                'count' => (int)$item->count
            ];
        });
    }

    /**
     * Get top pages by share count
     */
    private function getTopPages($startDate, $endDate, $platform = 'all', $limit = 10)
    {
        // Get article shares - use join to get article details
        $articleQuery = DB::table('socialdata')
            ->join('articles', 'socialdata.article_id', '=', 'articles.id')
            ->select('socialdata.article_id', 'articles.title', 'articles.slug', DB::raw('count(*) as count'))
            ->whereNotNull('socialdata.article_id')
            ->whereBetween('socialdata.created_at', [$startDate, $endDate]);
        
        if ($platform !== 'all') {
            $articleQuery->where('socialdata.platform', $platform);
        }
        
        $articleShares = $articleQuery
            ->groupBy('socialdata.article_id', 'articles.title', 'articles.slug')
            ->orderBy('count', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                return [
                    'url' => route('article.show', $item->slug),
                    'title' => $item->title,
                    'count' => $item->count
                ];
            });

        // Get non-article page shares (where article_id is null)
        $pageQuery = DB::table('socialdata')
            ->select('page_url', DB::raw('count(*) as count'))
            ->whereNull('article_id')
            ->whereNotNull('page_url')
            ->whereBetween('created_at', [$startDate, $endDate]);
        
        if ($platform !== 'all') {
            $pageQuery->where('platform', $platform);
        }
        
        $pageShares = $pageQuery
            ->groupBy('page_url')
            ->orderBy('count', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                return [
                    'url' => $item->page_url,
                    'title' => parse_url($item->page_url, PHP_URL_PATH) ?: $item->page_url,
                    'count' => $item->count
                ];
            });

        // Combine and sort by count
        return $articleShares->concat($pageShares)
            ->sortByDesc('count')
            ->take($limit)
            ->values();
    }

    /**
     * Get detailed platform statistics
     */
    private function getPlatformStats($startDate, $endDate, $platform = 'all')
    {
        $platforms = SocialShareClick::getAvailablePlatforms();
        $totalClicks = $this->getTotalClicks($startDate, $endDate, $platform);
        
        $stats = [];
        foreach ($platforms as $platformName) {
            // If filtering by specific platform, only show that one
            if ($platform !== 'all' && $platform !== $platformName) {
                continue;
            }
            
            $platformCount = DB::table('socialdata')
                ->where('platform', $platformName)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();
            
            $stats[$platformName] = [
                'total' => $platformCount,
                'percentage' => $totalClicks > 0 
                    ? round(($platformCount / $totalClicks) * 100, 2)
                    : 0
            ];
        }

        return $stats;
    }
}

