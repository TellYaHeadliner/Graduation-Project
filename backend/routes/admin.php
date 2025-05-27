<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['RoleCheck:Admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\Dashboard\DashboardController::class, 'index'])->name('dashboard');
    // amenities
    Route::prefix('/amenities')->as('amenity.')->group(function () {
        Route::controller(App\Http\Controllers\Admin\Amenity\AmenityController::class)->group(function () {

            Route::get('/them', 'create')->name('create');
            Route::post('/them', 'store')->name('store');

            Route::get('/', 'index')->name('index');
            Route::get('/sua/{id}', 'edit')->name('edit');

            Route::put('/sua', 'update')->name('update');

            Route::delete('/xoa/{id}', 'delete')->name('delete');
        });
    });

    Route::prefix('/search')->as('search.')->group(function () {
        Route::prefix('/select')->as('select.')->group(function () {
           Route::get('/amenities', [App\Http\Controllers\Admin\Amenity\AmenitySearchSelectController::class, 'selectSearch'])->name('amenities');
        });
    });
});
