<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'slug',
        'featured_image',
        'category',
        'type',
        'source',
        'source_logo',
        'reading_time',
        'is_published',
        'published_at',
        'views',
        'admin_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'reading_time' => 'integer',
        'views' => 'integer',
    ];

    // Categories constants
    const CATEGORY_NATION = 'nation';
    const CATEGORY_ECONOMY = 'economy';
    const CATEGORY_TECH = 'tech';
    const CATEGORY_POLITICS = 'politics';
    const CATEGORY_BUSINESS = 'business';
    const CATEGORY_SPORTS = 'sports';
    const CATEGORY_HEALTH = 'health';
    const CATEGORY_WORLD = 'world';

    // Type constants
    const TYPE_BREAKING = 'breaking';
    const TYPE_FEATURED = 'featured';
    const TYPE_NORMAL = 'normal';

    /**
     * Get the admin that created this article
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Scope for published articles
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope for breaking news
     */
    public function scopeBreaking($query)
    {
        return $query->where('type', self::TYPE_BREAKING);
    }

    /**
     * Scope for featured articles
     */
    public function scopeFeatured($query)
    {
        return $query->where('type', self::TYPE_FEATURED);
    }

    /**
     * Scope by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get formatted published date
     */
    public function getFormattedDateAttribute()
    {
        return $this->published_at?->format('M d, Y @ g:ia');
    }

    /**
     * Get time ago string
     */
    public function getTimeAgoAttribute()
    {
        if (!$this->published_at) {
            return null;
        }
        return $this->published_at->diffForHumans();
    }

    /**
     * Get category badge color for DaisyUI
     */
    public function getCategoryBadgeColorAttribute()
    {
        return match($this->category) {
            self::CATEGORY_NATION => 'primary',
            self::CATEGORY_ECONOMY => 'success',
            self::CATEGORY_TECH => 'warning',
            self::CATEGORY_POLITICS => 'secondary',
            self::CATEGORY_BUSINESS => 'accent',
            self::CATEGORY_SPORTS => 'info',
            self::CATEGORY_HEALTH => 'error',
            self::CATEGORY_WORLD => 'primary',
            default => 'neutral',
        };
    }

    /**
     * Get category icon
     */
    public static function getCategoryIcon($category)
    {
        return match($category) {
            self::CATEGORY_WORLD => '<circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>',
            self::CATEGORY_POLITICS => '<path d="M2 3v18h20V3H2Zm2 2h16v14H4V5Zm4 4h8v2H8V9Zm0 4h8v2H8v-2Z"/>',
            self::CATEGORY_BUSINESS => '<line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>',
            self::CATEGORY_TECH => '<rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line>',
            self::CATEGORY_SPORTS => '<circle cx="12" cy="12" r="10"></circle><path d="m14.31 8 5.74 9.94"></path><path d="M9.69 8h-3.71"></path><path d="M14.31 16H3.97"></path><path d="m20.03 16-1.74-3-3.03-5.25"></path>',
            self::CATEGORY_HEALTH => '<path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>',
            self::CATEGORY_NATION => '<path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>',
            self::CATEGORY_ECONOMY => '<line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>',
            default => '<circle cx="12" cy="12" r="10"></circle>',
        };
    }

    /**
     * Get category display name
     */
    public static function getCategoryDisplayName($category)
    {
        return match($category) {
            self::CATEGORY_WORLD => 'World',
            self::CATEGORY_POLITICS => 'Politics',
            self::CATEGORY_BUSINESS => 'Business',
            self::CATEGORY_TECH => 'Technology',
            self::CATEGORY_SPORTS => 'Sports',
            self::CATEGORY_HEALTH => 'Health',
            self::CATEGORY_NATION => 'Nation',
            self::CATEGORY_ECONOMY => 'Economy',
            default => ucfirst($category),
        };
    }

    /**
     * Get category badge color (static method)
     */
    public static function getCategoryBadgeColor($category)
    {
        return match($category) {
            self::CATEGORY_NATION => 'primary',
            self::CATEGORY_ECONOMY => 'success',
            self::CATEGORY_TECH => 'warning',
            self::CATEGORY_POLITICS => 'secondary',
            self::CATEGORY_BUSINESS => 'accent',
            self::CATEGORY_SPORTS => 'info',
            self::CATEGORY_HEALTH => 'error',
            self::CATEGORY_WORLD => 'primary',
            default => 'neutral',
        };
    }
}
