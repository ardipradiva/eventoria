<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('auth.login');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


// Admin Routes
// Route::middleware(['auth', 'role:admin'])->group(function () {
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/event', [AdminController::class, 'index'])->name('admin.event.index');
Route::get('/admin/event/create', [AdminController::class, 'create'])->name('admin.event.create');
Route::post('/admin/event', [AdminController::class, 'store'])->name('admin.event.store');
Route::get('/admin/event/{event}', [AdminController::class, 'show'])->name('admin.event.show');
Route::get('/admin/event/{event}/edit', [AdminController::class, 'edit'])->name('admin.event.edit');
Route::put('/admin/event/{event}', [AdminController::class, 'update'])->name('admin.event.update');
Route::delete('/admin/event/{event}', [AdminController::class, 'destroy'])->name('admin.event.destroy');
// });


// User Routes
// Route untuk dashboard pengguna
Route::get('/user/dashboard', [EventController::class, 'dashboard'])->name('user.dashboard');

// Route untuk melihat profil pengguna
Route::get('/user/profile', [EventController::class, 'profile'])->name('user.profile');

// Route untuk melihat cart pengguna
Route::get('/user/cart', [EventController::class, 'cart'])->name('user.cart');

// Route untuk melihat history pengguna
Route::get('/user/history', [EventController::class, 'history'])->name('user.history');

// Route untuk melihat semua event
Route::get('/user/events', [EventController::class, 'events'])->name('user.events');

Route::get('/user/event/{event}', [EventController::class, 'show'])->name('user.event.show');
Route::get('/user/event', [EventController::class, 'index'])->name('user.event.index');

