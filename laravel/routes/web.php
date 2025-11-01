<?php

use App\Http\Controllers\AdminAuthController;

// Welcome page for normal users
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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
});

