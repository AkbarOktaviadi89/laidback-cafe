<?php

// routes/web.php
use App\Http\Controllers\Customer\MenuController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Cashier\TransactionController;
use App\Http\Controllers\Cashier\PaymentController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\ProductController;
use App\Http\Controllers\Owner\UserController;
use App\Http\Controllers\Owner\ReportController;
use Illuminate\Support\Facades\Route;

// Public Routes (Customer)
Route::get('/', function () {
    return view('customer.welcome');
})->name('home');

Route::get('/qr/{table}', function ($table) {
    return redirect()->route('customer.name', ['table' => $table]);
})->name('qr.scan');

Route::prefix('order')->name('customer.')->group(function () {
    Route::get('/name', [MenuController::class, 'enterName'])->name('name');
    Route::post('/start', [MenuController::class, 'startOrder'])->name('start');
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    
    // Cart Routes
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::patch('/cart/{id}/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
    
    // Checkout Routes
    Route::get('/checkout', [CustomerOrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CustomerOrderController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/success/{order}', [CustomerOrderController::class, 'success'])->name('success');
});

// Authentication Routes
require __DIR__.'/auth.php';

// Cashier Routes
Route::middleware(['auth', 'cashier'])->prefix('cashier')->name('cashier.')->group(function () {
    Route::get('/dashboard', [TransactionController::class, 'index'])->name('dashboard');
    Route::get('/transactions', [TransactionController::class, 'list'])->name('transactions');
    Route::get('/transactions/{order}', [TransactionController::class, 'show'])->name('transactions.show');
    
    // Payment Routes
    Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment');
    Route::post('/payment/{order}', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/receipt/{order}', [PaymentController::class, 'receipt'])->name('receipt');
    Route::get('/print/{order}', [PaymentController::class, 'print'])->name('print');
});

// Owner Routes
Route::middleware(['auth', 'owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboard');
    
    // Product Management
    Route::resource('products', ProductController::class);
    Route::post('products/{product}/toggle', [ProductController::class, 'toggleAvailability'])->name('products.toggle');
    
    // User Management
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');
    
    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    
    // Transactions
    Route::get('/transactions', [OwnerDashboardController::class, 'transactions'])->name('transactions');
    Route::get('/transactions/{order}', [OwnerDashboardController::class, 'showTransaction'])->name('transactions.show');
});

// Generate QR Code for tables
Route::get('/generate-qr', function () {
    return view('admin.generate-qr');
})->middleware(['auth', 'owner'])->name('generate.qr');