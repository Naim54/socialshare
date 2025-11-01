<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialShareClick extends Model
{
    use HasFactory;

    protected $table = 'socialdata';

    protected $fillable = [
        'platform',
        'article_id',
        'page_url',
        'ip_address',
        'user_agent',
    ];

    /**
     * Get the article that was shared (if applicable)
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // Platform constants for flexibility
    const PLATFORM_FACEBOOK = 'facebook';
    const PLATFORM_TWITTER = 'twitter';
    const PLATFORM_WHATSAPP = 'whatsapp';
    const PLATFORM_TELEGRAM = 'telegram';
    const PLATFORM_EMAIL = 'email';

    /**
     * Get all available platforms
     */
    public static function getAvailablePlatforms(): array
    {
        return [
            self::PLATFORM_FACEBOOK,
            self::PLATFORM_TWITTER,
            self::PLATFORM_WHATSAPP,
            self::PLATFORM_TELEGRAM,
            self::PLATFORM_EMAIL,
        ];
    }

    /**
     * Scope for filtering by platform
     */
    public function scopeByPlatform($query, string $platform)
    {
        return $query->where('platform', $platform);
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
        return $query->where('page_url', $url);
    }
}

