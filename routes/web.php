<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication Routes
Auth::routes(['verify' => true]);

// Public Routes
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Post Resource Routes (except show which is public)
    Route::resource('posts', PostController::class)->except(['show']);
    
    // Additional routes can be added here
    // Example: Route for user profile
    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

// Admin Routes (example - if you need admin-specific routes)
Route::middleware(['auth', 'admin'])->group(function () {
    // Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
});

// Fallback Route (for 404 pages)
Route::fallback(function () {
    return view('errors.404');
});