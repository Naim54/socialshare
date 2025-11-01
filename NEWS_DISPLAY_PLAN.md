# News Display Plan - Database Integration

## Overview
This document outlines how news articles will be displayed on the welcome page based on data from the database.

## Database Structure

### Articles Table
The `articles` table stores all news articles with the following key fields:

- **Basic Info:**
  - `title` - Article headline
  - `excerpt` - Short summary (optional)
  - `content` - Full article content
  - `slug` - URL-friendly identifier
  - `featured_image` - Main image URL

- **Categorization:**
  - `category` - One of: nation, economy, tech, politics, business, sports, health, world
  - `type` - One of: breaking, featured, normal

- **Metadata:**
  - `source` - Publication name (e.g., "STRAITS TIMES", "GlobalSource")
  - `source_logo` - Logo/avatar URL for the publication
  - `reading_time` - Estimated reading time in minutes

- **Status:**
  - `is_published` - Boolean flag
  - `published_at` - Publication timestamp
  - `views` - View counter

- **Relations:**
  - `admin_id` - Who created the article

## Display Sections

### 1. Breaking News Banner (Scrolling)
**Data Source:** `Article::published()->breaking()->limit(4)`
- Shows articles where `type = 'breaking'`
- Displays in the horizontal scrolling banner
- Shows category badge and title
- Auto-scrolls continuously

**Fields Used:**
- `category` (for badge color)
- `title`
- `type` (must be 'breaking')

### 2. Featured Stories (Hero Slider)
**Data Source:** `Article::published()->featured()->limit(4)`
- Shows articles where `type = 'featured'`
- Displays in the hero image slider
- Shows image background with title overlay
- Auto-rotates every 5 seconds

**Fields Used:**
- `featured_image`
- `title`

### 3. HEARD THE NEWS? Section
**Data Source:** `Article::published()->latest()->limit(3)`
- Shows the 3 most recent published articles
- Displays in horizontal card layout
- Shows image, category, date/time, and title

**Fields Used:**
- `featured_image`
- `category`
- `published_at` (formatted as "Oct 31, 2025 @ 6:50am")
- `title`
- `source` (for STRAITS TIMES badge)

### 4. Article Grid
**Data Source:** `Article::published()->paginate(12)`
- Shows all published articles
- Displays in responsive grid layout
- Shows image, source avatar, title, source name, and metadata

**Fields Used:**
- `featured_image`
- `source_logo` (or generated from source name)
- `title`
- `source`
- `published_at` (formatted as "X hours ago")
- `reading_time`

## Implementation Steps

1. ✅ **Created Article Model** (`app/Models/Article.php`)
   - Includes scopes: `published()`, `breaking()`, `featured()`, `byCategory()`
   - Helper methods for formatting dates and badge colors

2. ✅ **Created Migration** (`database/migrations/2025_01_15_000001_create_articles_table.php`)
   - All necessary fields defined
   - Indexes for performance

3. ✅ **Created WelcomeController** (`app/Http/Controllers/WelcomeController.php`)
   - Fetches breaking news, featured articles, latest articles, and paginated articles
   - Passes data to the view

4. ✅ **Updated Routes** (`routes/web.php`)
   - Changed from closure to WelcomeController

5. ✅ **Created ArticleSeeder** (`database/seeders/ArticleSeeder.php`)
   - Sample data for all sections
   - Matches current static content

6. ⏳ **Next Steps:**
   - Update `welcome.blade.php` to use dynamic data
   - Run migrations and seeders
   - Test the display

## View Updates Needed

### Breaking News Section
Replace static items with:
```php
@foreach($breakingNews as $article)
    <div class="highlight-item flex-shrink-0 flex items-center space-x-3">
        <span class="badge badge-{{ $article->category_badge_color }} font-bold">{{ strtoupper($article->category) }}</span>
        <span class="text-sm">{{ $article->title }}</span>
    </div>
@endforeach
<!-- Duplicate for seamless loop -->
```

### Featured Stories Section
Replace static slides with:
```php
@foreach($featuredArticles as $index => $article)
    <div class="hero-slide" style="background-image: url('{{ $article->featured_image }}');">
        <div class="hero-slide-content">
            <h2>{{ $article->title }}</h2>
        </div>
    </div>
@endforeach
```

### HEARD THE NEWS? Section
Replace static cards with:
```php
@foreach($heardTheNews as $article)
    <div class="card...">
        <figure>
            <img src="{{ $article->featured_image }}" />
            <div class="badge badge-primary">{{ $article->source }}</div>
        </figure>
        <div class="card-body">
            <div>{{ ucfirst($article->category) }}</div>
            <div>{{ $article->formatted_date }}</div>
            <h3>{{ $article->title }}</h3>
        </div>
    </div>
@endforeach
```

### Article Grid
Replace static cards with:
```php
@foreach($articles as $article)
    <div class="card...">
        <figure>
            <img src="{{ $article->featured_image }}" />
        </figure>
        <div class="card-body">
            <div class="avatar">
                <img src="{{ $article->source_logo }}" />
            </div>
            <h3>{{ $article->title }}</h3>
            <p>{{ $article->source }}</p>
            <p>{{ $article->time_ago }} • {{ $article->reading_time }} min read</p>
        </div>
    </div>
@endforeach

{{ $articles->links() }} <!-- Pagination -->
```

## Commands to Run

```bash
# Run migrations
make artisan ARGS='migrate'

# Run seeders
make artisan ARGS='db:seed'

# Or run both
make artisan ARGS='migrate --seed'
```

## Notes

- All articles must have `is_published = true` and `published_at <= now()` to appear
- Breaking news limited to 4 items
- Featured articles limited to 4 items
- HEARD THE NEWS? shows latest 3 articles
- Article grid uses pagination (12 per page)
- Categories map to DaisyUI badge colors automatically
- Dates formatted using Carbon (time_ago for relative, formatted_date for absolute)

