<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\SocialShareController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes - Authentication
Route::post('/auth/login', [AuthController::class, 'login'])->name('api.auth.login');
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth.api')->name('api.auth.logout');

// Public routes - Social Share Tracking
Route::post('/social-share/track', [SocialShareController::class, 'track'])->name('api.social-share.track');

// Protected routes - Articles
Route::middleware(['auth.api'])->group(function () {
    Route::prefix('articles')->group(function () {
        Route::get('/breaking', [ArticleController::class, 'breaking'])->name('api.articles.breaking');
        Route::get('/featured', [ArticleController::class, 'featured'])->name('api.articles.featured');
        Route::get('/latest', [ArticleController::class, 'latest'])->name('api.articles.latest');
        Route::get('/', [ArticleController::class, 'index'])->name('api.articles.index');
        Route::get('/{slug}', [ArticleController::class, 'show'])->name('api.articles.show');
        Route::get('/category/{category}', [ArticleController::class, 'byCategory'])->name('api.articles.category');
    });
});

