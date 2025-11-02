<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'url',
        'referrer',
        'article_id',
        'country',
        'city',
        'device_type',
        'browser',
        'os',
    ];

    /**
     * Get the article that was visited (if applicable)
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Scope for filtering by date range
     */
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Scope for filtering by URL
     */
    public function scopeByUrl($query, string $url)
    {
        return $query->where('url', $url);
    }

    /**
     * Scope for filtering by article
     */
    public function scopeByArticle($query, $articleId)
    {
        return $query->where('article_id', $articleId);
    }

    /**
     * Get unique visitors count
     */
    public static function getUniqueVisitors($startDate = null, $endDate = null)
    {
        $query = static::select('ip_address')
            ->distinct();

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        return $query->count();
    }

    /**
     * Get total visits count
     */
    public static function getTotalVisits($startDate = null, $endDate = null)
    {
        $query = static::query();

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        return $query->count();
    }

    /**
     * Get visits grouped by date
     */
    public static function getVisitsByDate($startDate = null, $endDate = null)
    {
        $query = static::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date');

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        return $query->get();
    }
}


