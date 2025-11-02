<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
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
     * Get category icon (matching dashboard icons)
     */
    public static function getCategoryIcon($category)
    {
        return match($category) {
            self::CATEGORY_WORLD => 'fas fa-globe',
            self::CATEGORY_POLITICS => 'fas fa-landmark',
            self::CATEGORY_BUSINESS => 'fas fa-briefcase',
            self::CATEGORY_TECH => 'fas fa-microchip',
            self::CATEGORY_SPORTS => 'fas fa-futbol',
            self::CATEGORY_HEALTH => 'fas fa-heartbeat',
            self::CATEGORY_NATION => 'fas fa-flag',
            self::CATEGORY_ECONOMY => 'fas fa-chart-line',
            default => 'fas fa-newspaper',
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

    /**
     * Get the full URL for the featured image
     * Returns the storage URL if it's a local file, or the original URL if it's external
     */
    public function getFeaturedImageUrlAttribute()
    {
        if (!$this->featured_image) {
            return null;
        }

        // If it's already a full URL (external), return as is
        if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
            return $this->featured_image;
        }

        // Determine the image path
        $imagePath = $this->featured_image;
        
        // If it's just a filename (like '3601005.webp') or doesn't start with 'images/articles/', prepend it
        if (!str_starts_with($imagePath, 'images/articles/')) {
            // If it's already a path but doesn't start with our directory, just use filename
            if (str_contains($imagePath, '/')) {
                // Extract just the filename from any path
                $imagePath = basename($imagePath);
            }
            $imagePath = 'images/articles/' . $imagePath;
        }

        // Use asset() helper which automatically uses the correct base URL (respects current port)
        // Images are stored directly in public/images/articles/ (no symlink needed)
        return asset($imagePath);
    }

    /**
     * Upload and store a featured image
     * 
     * @param UploadedFile $file
     * @param string|null $oldImagePath The old image path to delete (optional)
     * @return string The stored image path
     */
    public function uploadFeaturedImage(UploadedFile $file, ?string $oldImagePath = null): string
    {
        // Delete old image if provided
        if ($oldImagePath) {
            $oldFullPath = public_path($oldImagePath);
            if (file_exists($oldFullPath)) {
                unlink($oldFullPath);
            }
        }

        // Ensure directory exists
        $uploadPath = public_path('images/articles');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        // Store directly in public/images/articles/ (no symlink needed)
        $file->move($uploadPath, $filename);
        
        return 'images/articles/' . $filename;
    }

    /**
     * Delete the featured image file from storage
     */
    public function deleteFeaturedImage(): bool
    {
        if ($this->featured_image && str_starts_with($this->featured_image, 'images/articles/')) {
            $imagePath = public_path($this->featured_image);
            if (file_exists($imagePath)) {
                return unlink($imagePath);
            }
        }
        return false;
    }

    /**
     * Boot method to handle image deletion when article is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($article) {
            // Delete image when article is soft deleted or permanently deleted
            $article->deleteFeaturedImage();
        });

        static::updating(function ($article) {
            // Delete old image if a new one is being uploaded
            if ($article->isDirty('featured_image')) {
                $oldImagePath = $article->getOriginal('featured_image');
                if ($oldImagePath && str_starts_with($oldImagePath, 'images/articles/')) {
                    $oldFullPath = public_path($oldImagePath);
                    if (file_exists($oldFullPath)) {
                        unlink($oldFullPath);
                    }
                }
            }
        });
    }
}
