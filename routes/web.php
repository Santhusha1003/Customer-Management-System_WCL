<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CustomerController::class, 'dashboard'])->name('dashboard');

Route::view('/profile', 'pages.profile')->name('profile');
Route::view('/settings', 'pages.settings')->name('settings');
Route::view('/about', 'pages.about')->name('about');

Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');

Route::resource('customers', CustomerController::class);
