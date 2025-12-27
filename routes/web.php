<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Member Controllers
use App\Http\Controllers\Member\SuratController as MemberSuratController;
use App\Http\Controllers\Member\MarketplaceController;
use App\Http\Controllers\Member\BookingController as MemberBookingController;

// Admin Controllers
use App\Http\Controllers\Admin\SuratController as AdminSuratController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\MemberController;

Route::get('/', function () {
    return view('welcome');
});

// Member Routes
Route::middleware(['auth', 'verified'])->prefix('member')->name('member.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('member.dashboard');
    })->name('dashboard');

    // Surat
    Route::prefix('surat')->name('surat.')->group(function () {
        Route::get('/', [MemberSuratController::class, 'index'])->name('index');
        Route::get('/create', [MemberSuratController::class, 'create'])->name('create');
        Route::post('/', [MemberSuratController::class, 'store'])->name('store');
        Route::get('/{surat}', [MemberSuratController::class, 'show'])->name('show');
        Route::get('/{surat}/download', [MemberSuratController::class, 'download'])->name('download');
    });

    // Marketplace
    Route::prefix('marketplace')->name('marketplace.')->group(function () {
        Route::get('/', [MarketplaceController::class, 'index'])->name('index');
        Route::get('/{product}', [MarketplaceController::class, 'show'])->name('show');
        Route::post('/{product}/order', [MarketplaceController::class, 'order'])->name('order');
    });

    // Orders
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [MarketplaceController::class, 'orders'])->name('index');
        Route::get('/{order}', [MarketplaceController::class, 'showOrder'])->name('show');
        Route::post('/{order}/payment', [MarketplaceController::class, 'uploadPayment'])->name('payment');
    });

    // Member Booking
    Route::prefix('booking')->name('booking.')->group(function () {
        Route::get('/', [MemberBookingController::class, 'index'])->name('index');
        Route::get('/my-bookings', [MemberBookingController::class, 'myBookings'])->name('my-bookings');
        Route::get('/{equipment}', [MemberBookingController::class, 'show'])->name('show');
        Route::get('/{equipment}/create', [MemberBookingController::class, 'create'])->name('create');
        Route::post('/{equipment}', [MemberBookingController::class, 'store'])->name('store');
        Route::get('/detail/{booking}', [MemberBookingController::class, 'showBooking'])->name('detail');
        Route::post('/detail/{booking}/payment', [MemberBookingController::class, 'uploadPayment'])->name('payment');
    });
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Surat Management
    Route::prefix('surat')->name('surat.')->group(function () {
        Route::get('/', [AdminSuratController::class, 'index'])->name('index');
        Route::get('/{surat}', [AdminSuratController::class, 'show'])->name('show');
        Route::post('/{surat}/approve', [AdminSuratController::class, 'approve'])->name('approve');
        Route::post('/{surat}/reject', [AdminSuratController::class, 'reject'])->name('reject');
    });

    // Product Management
    Route::resource('products', ProductController::class);

    // Order Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::post('/{order}/status', [OrderController::class, 'updateStatus'])->name('status');
    });

    // Admin Equipment
    Route::resource('equipment', EquipmentController::class);

    // Admin Bookings
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\BookingController::class, 'index'])->name('index');
        Route::get('/{booking}', [\App\Http\Controllers\Admin\BookingController::class, 'show'])->name('show');
        Route::post('/{booking}/approve', [\App\Http\Controllers\Admin\BookingController::class, 'approve'])->name('approve');
        Route::post('/{booking}/reject', [\App\Http\Controllers\Admin\BookingController::class, 'reject'])->name('reject');
        Route::post('/{booking}/status', [\App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('status');
    });

    // Member Management
    Route::resource('members', MemberController::class);
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';