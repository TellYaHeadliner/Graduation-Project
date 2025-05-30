<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['RoleCheck:Owner'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\Dashboard\DashboardController::class, 'index'])->name('dashboard');

});
