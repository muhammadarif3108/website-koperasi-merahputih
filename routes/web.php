<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Member Controllers
use App\Http\Controllers\Member\SuratController as MemberSuratController;
use App\Http\Controllers\Member\MarketplaceController;
use App\Http\Controllers\Member\SimpananController as MemberSimpananController;

// Admin Controllers
use App\Http\Controllers\Admin\SuratController as AdminSuratController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SimpananController as AdminSimpananController;
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

    // Simpanan
    Route::prefix('simpanan')->name('simpanan.')->group(function () {
        Route::get('/', [MemberSimpananController::class, 'index'])->name('index');
        Route::get('/create', [MemberSimpananController::class, 'create'])->name('create');
        Route::post('/', [MemberSimpananController::class, 'store'])->name('store');
        Route::get('/{simpanan}', [MemberSimpananController::class, 'show'])->name('show');
        Route::get('/riwayat/history', [MemberSimpananController::class, 'history'])->name('history');
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

    // Simpanan Management
    Route::prefix('simpanan')->name('simpanan.')->group(function () {
        Route::get('/', [AdminSimpananController::class, 'index'])->name('index');
        Route::get('/{simpanan}', [AdminSimpananController::class, 'show'])->name('show');
        Route::post('/{simpanan}/approve', [AdminSimpananController::class, 'approve'])->name('approve');
        Route::post('/{simpanan}/reject', [AdminSimpananController::class, 'reject'])->name('reject');
        Route::get('/members/list', [AdminSimpananController::class, 'members'])->name('members');
        Route::get('/members/{user}', [AdminSimpananController::class, 'memberDetail'])->name('member-detail');
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
