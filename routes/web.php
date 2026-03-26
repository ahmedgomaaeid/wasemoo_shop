<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\SectionController as AdminSectionController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

// Default auth route redirect
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Static Pages
Route::get('/terms-and-policies', function () {
    return view('frontend.terms');
})->name('terms');

// Contact Us
Route::get('/contact-us', [\App\Http\Controllers\ContactController::class, 'index'])->name('frontend.contact');
Route::post('/contact-us', [\App\Http\Controllers\ContactController::class, 'store'])->name('frontend.contact.store');

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/section/{slug}', [HomeController::class, 'section'])->name('frontend.section');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('frontend.product');

use App\Http\Controllers\CheckoutController;
// Checkout Routes
Route::post('/checkout/{product}', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/callback', [CheckoutController::class, 'callback'])->name('checkout.callback');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/failed/{order}', [CheckoutController::class, 'failed'])->name('checkout.failed');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin Routes
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminAuthController::class, 'login']);
    });

    // Authenticated Admin Routes
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        Route::get('/', function() {
            return redirect()->route('admin.sections.index');
        })->name('dashboard');

        Route::resource('sections', AdminSectionController::class);
        Route::resource('products', AdminProductController::class);
        Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class)->only(['index', 'show', 'destroy']);
    });
});
