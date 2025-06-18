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
    Route::prefix('/amenities')->as('amenity.')->group(function () {
        Route::controller(App\Http\Controllers\Hotel\Amenity\AmenityController::class)->group(function () {

            Route::get('/{hotel_id}', 'index')->name('index');

            Route::put('/{hotel_id}/sua', 'update')->name('update');
        });
    });
    Route::prefix('/information')->as('information.')->group(function () {
        Route::controller(App\Http\Controllers\Hotel\Hotel\HotelController::class)->group(function () {

            Route::get('/{hotel_id}', 'index')->name('index');

            Route::put('/{hotel_id}/sua', 'update')->name('update');
        });
    });
    // amenities
    Route::prefix('/hotel_services')->as('hotel_service.')->group(function () {
        Route::controller(App\Http\Controllers\Hotel\HotelService\HotelServiceController::class)->group(function () {

            Route::get('/{hotel_id}/them', 'create')->name('create');
            Route::post('/{hotel_id}/them', 'store')->name('store');

            Route::get('/{hotel_id}', 'index')->name('index');
            Route::get('/{hotel_id}sua/{id}', 'edit')->name('edit');

            Route::put('/{hotel_id}/sua', 'update')->name('update');

            Route::delete('/{hotel_id}/xoa/{id}', 'delete')->name('delete');
        });
    });
    // Combos
    Route::prefix('/combos')->as('combo.')->group(function () {
        Route::controller(App\Http\Controllers\Hotel\Combo\ComboController::class)->group(function () {

            Route::get('/{hotel_id}/them', 'create')->name('create');
            Route::post('/{hotel_id}/them', 'store')->name('store');

            Route::get('/{hotel_id}', 'index')->name('index');
            Route::get('/{hotel_id}sua/{id}', 'edit')->name('edit');

            Route::put('/{hotel_id}/sua', 'update')->name('update');

            Route::delete('/{hotel_id}/xoa/{id}', 'delete')->name('delete');
        });
    });

});
