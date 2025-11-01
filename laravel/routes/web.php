<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\SocialShareAnalyticsController;

// Welcome page for normal users
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Article detail page
Route::get('/article/{slug}', [WelcomeController::class, 'show'])->name('article.show');

// Category page
Route::get('/category/{category}', [WelcomeController::class, 'category'])->name('category.show');

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Debug route - remove this after testing
Route::get('/admin/debug', function () {
    $admin = App\Models\Admin::where('email', 'admin@test.com')->first();
    if ($admin) {
        return response()->json([
            'admin_found' => true,
            'name' => $admin->name,
            'email' => $admin->email,
            'password_check' => password_verify('admin12345', $admin->password),
            'password_hash' => $admin->password
        ]);
    }
    return response()->json(['admin_found' => false]);
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/admin/api/social-share/analytics', [SocialShareAnalyticsController::class, 'index'])->name('admin.social-share.analytics');
});

