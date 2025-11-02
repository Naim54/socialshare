<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Get breaking news articles
     */
    public function breaking(Request $request)
    {
        $limit = $request->input('limit', 4);
        
        $articles = Article::published()
            ->breaking()
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($article) {
                return $this->formatArticle($article);
            });

        return response()->json([
            'success' => true,
            'data' => $articles,
            'count' => $articles->count(),
        ], 200);
    }

    /**
     * Get featured articles
     */
    public function featured(Request $request)
    {
        $limit = $request->input('limit', 4);
        
        $articles = Article::published()
            ->featured()
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($article) {
                return $this->formatArticle($article);
            });

        return response()->json([
            'success' => true,
            'data' => $articles,
            'count' => $articles->count(),
        ], 200);
    }

    /**
     * Get latest articles
     */
    public function latest(Request $request)
    {
        $limit = $request->input('limit', 3);
        
        $articles = Article::published()
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($article) {
                return $this->formatArticle($article);
            });

        return response()->json([
            'success' => true,
            'data' => $articles,
            'count' => $articles->count(),
        ], 200);
    }

    /**
     * Get all articles (paginated)
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 12);
        $category = $request->input('category');
        $type = $request->input('type');

        $query = Article::published();

        if ($category) {
            $query->byCategory($category);
        }

        if ($type) {
            $query->where('type', $type);
        }

        $articles = $query->orderBy('published_at', 'desc')
            ->paginate($perPage);

        $articles->getCollection()->transform(function ($article) {
            return $this->formatArticle($article);
        });

        return response()->json([
            'success' => true,
            'data' => $articles->items(),
            'pagination' => [
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total(),
            ],
        ], 200);
    }

    /**
     * Get single article by slug
     */
    public function show($slug)
    {
        $article = Article::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views
        $article->increment('views');

        return response()->json([
            'success' => true,
            'data' => $this->formatArticle($article, true), // Include full content
        ], 200);
    }

    /**
     * Get articles by category
     */
    public function byCategory($category, Request $request)
    {
        $perPage = $request->input('per_page', 12);

        $articles = Article::published()
            ->byCategory($category)
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);

        $articles->getCollection()->transform(function ($article) {
            return $this->formatArticle($article);
        });

        return response()->json([
            'success' => true,
            'data' => $articles->items(),
            'category' => $category,
            'pagination' => [
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total(),
            ],
        ], 200);
    }

    /**
     * Format article for API response
     */
    private function formatArticle(Article $article, bool $includeFullContent = false)
    {
        $data = [
            'id' => $article->id,
            'title' => $article->title,
            'excerpt' => $article->excerpt,
            'slug' => $article->slug,
            'featured_image' => $article->featured_image_url,
            'category' => $article->category,
            'category_badge_color' => $article->category_badge_color,
            'type' => $article->type,
            'source' => $article->source,
            'source_logo' => $article->source_logo,
            'reading_time' => $article->reading_time,
            'published_at' => $article->published_at?->toIso8601String(),
            'formatted_date' => $article->formatted_date,
            'time_ago' => $article->time_ago,
            'views' => $article->views,
        ];

        if ($includeFullContent) {
            $data['content'] = $article->content;
        }

        return $data;
    }
}

