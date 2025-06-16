<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['roleCheck:Owner', 'hotelOwnerCheck'])->group(function () {
    Route::get('/dashboard/{hotel_id}', [App\Http\Controllers\Hotel\Dashboard\DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('/hotel-rules')->as('hotel_rules.')->group(function () {
        Route::controller(App\Http\Controllers\Hotel\HotelRules\HotelRulesController::class)->group(function () {

            Route::get('/{hotel_id}', 'index')->name('index');

            Route::put('/{hotel_id}/sua', 'update')->name('update');

        });
    });
});
