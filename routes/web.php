<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

// Route Publik
Route::get('/', function () {
    return view('public.home');
});
Route::get('/about', function () {
    return view('public.about');
});
Route::get('/contact', function () {
    return view('public.contact');
});

// Route Auth Manual (Pastikan /login punya ->name('login'))
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Route Khusus User
Route::middleware(['role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard']);
});

// Route Khusus Admin
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::resource('admin/categories', CategoryController::class)
        ->only(['store', 'update', 'destroy'])
        ->names('admin.categories');
    Route::resource('admin/books', BookController::class)
        ->except(['index', 'create', 'show'])
        ->names('admin.books');
});