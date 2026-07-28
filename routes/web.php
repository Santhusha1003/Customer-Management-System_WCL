<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CustomerController::class, 'dashboard'])->name('dashboard');

Route::resource('customers', CustomerController::class);
