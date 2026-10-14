<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\PlannerController;
use App\Http\Controllers\GuidesController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AiAssistantController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;

// ===== Public Routes =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
Route::get('/guides', [GuidesController::class, 'index'])->name('guides');

// Category-wise Explore
Route::get('/explore/category/{category}', [CategoryController::class, 'show'])->name('category.show');

// Planner
Route::get('/planner', [PlannerController::class, 'index'])->name('planner');
Route::post('/planner/generate', [PlannerController::class, 'generate'])->name('planner.generate');

// Destination Detail
Route::get('/destination/{id}', [ExploreController::class, 'show'])->name('destination.show');

// Favorites (session-based — guest bhi use kar sakta hai)
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
Route::post('/favorites/clear', [FavoriteController::class, 'clear'])->name('favorites.clear');

// AI Assistant
Route::get('/ai-assistant', [AiAssistantController::class, 'index'])->name('ai.assistant');
Route::post('/ai-assistant/chat', [AiAssistantController::class, 'chat'])->name('ai.assistant.chat');

// ===== USER Authentication =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ===== ADMIN Authentication (separate) =====
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showAdminLoginForm'])->name('login.form');
        Route::post('/login', [LoginController::class, 'adminLogin'])->name('login.submit');
    });
});

// ===== Authenticated User Routes =====
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Booking
    Route::get('/booking/{id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/success/{reference}', [BookingController::class, 'success'])->name('booking.success');
    Route::post('/booking/calculate-price', [BookingController::class, 'calculatePrice'])->name('booking.calculate');
});

// ===== Admin Protected Routes =====
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');
    Route::get('/bookings', [DashboardController::class, 'bookings'])->name('bookings');
    Route::get('/ai-chats', [DashboardController::class, 'aiChats'])->name('ai.chats');

    // Booking status update (NEW)
    Route::patch('/bookings/{id}/status', [DashboardController::class, 'updateBookingStatus'])->name('bookings.status');
});