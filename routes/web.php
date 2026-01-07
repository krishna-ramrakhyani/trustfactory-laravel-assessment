<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/products', \App\Livewire\ProductList::class)->name('products');
    Route::get('/cart', \App\Livewire\CartView::class)->name('cart');
});

require __DIR__.'/auth.php';
