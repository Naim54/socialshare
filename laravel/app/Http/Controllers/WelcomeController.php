<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display the welcome page with articles
     */
    public function index()
    {
        // Get breaking news articles for the scrolling banner
        $breakingNews = Article::published()
            ->breaking()
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();

        // Get featured articles for the hero slider
        $featuredArticles = Article::published()
            ->featured()
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();

        // Get articles for "HEARD THE NEWS?" section (latest 3)
        $heardTheNews = Article::published()
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Get all published articles for the main grid (paginated)
        $articles = Article::published()
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        // If AJAX request, return only article grid partial
        if (request()->ajax()) {
            return view('partials.article-grid', compact('articles'));
        }

        return view('welcome', compact('breakingNews', 'featuredArticles', 'heardTheNews', 'articles'));
    }

    /**
     * Display a single article
     */
    public function show($slug)
    {
        $article = Article::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views
        $article->increment('views');

        // Get related articles (same category, exclude current)
        $relatedArticles = Article::published()
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();

        // Get latest articles for sidebar
        $latestArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->get();

        return view('article.show', compact('article', 'relatedArticles', 'latestArticles'));
    }

    /**
     * Display articles by category
     */
    public function category($category)
    {
        // Get all published articles for the category (paginated)
        $articles = Article::published()
            ->byCategory($category)
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        // If AJAX request, return only article grid partial
        if (request()->ajax()) {
            return view('partials.article-grid', compact('articles', 'category'));
        }

        return view('category.show', compact('articles', 'category'));
    }

    /**
     * Get distinct categories from published articles
     */
    public static function getDistinctCategories()
    {
        return Article::published()
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->orderBy('category')
            ->pluck('category')
            ->toArray();
    }
}

