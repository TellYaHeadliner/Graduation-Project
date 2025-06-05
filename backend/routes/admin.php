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
    // bed_types
    Route::prefix('/bed-types')->as('bed_type.')->group(function () {
        Route::controller(App\Http\Controllers\Admin\BedType\BedTypeController::class)->group(function () {

            Route::get('/them', 'create')->name('create');
            Route::post('/them', 'store')->name('store');

            Route::get('/', 'index')->name('index');
            Route::get('/sua/{id}', 'edit')->name('edit');

            Route::put('/sua', 'update')->name('update');

            Route::delete('/xoa/{id}', 'delete')->name('delete');
        });
    });
    // Users
    Route::prefix('/users')->as('user.')->group(function () {
        Route::controller(App\Http\Controllers\Admin\User\UserController::class)->group(function () {

            Route::get('/them', 'create')->name('create');
            Route::post('/them', 'store')->name('store');

            Route::get('/', 'index')->name('index');
            Route::get('/sua/{id}', 'edit')->name('edit');

            Route::put('/sua', 'update')->name('update');

            Route::delete('/xoa/{id}', 'delete')->name('delete');
        });
    });
    // Hotel
    Route::prefix('/hotels')->as('hotel.')->group(function () {
        Route::controller(App\Http\Controllers\Admin\Hotel\HotelController::class)->group(function () {

            Route::get('/them', 'create')->name('create');
            Route::post('/them', 'store')->name('store');

            Route::get('/', 'index')->name('index');
            Route::get('/sua/{id}', 'edit')->name('edit');

            Route::put('/sua', 'update')->name('update');

            Route::delete('/xoa/{id}', 'delete')->name('delete');
            // Hotel-Approval
            Route::get('/Hotel-Approval', 'indexHotelAppoval')->name('indexHotelAppoval');
            Route::get('/Hotel-Approval/{id}', 'editHotelAppoval')->name('editHotelAppoval');

            Route::put('/updateHotel-Approval', 'updateHotelApproval')->name('updateHotelApproval');
        });
    });
    // Service
    Route::prefix('/services')->as('service.')->group(function () {
        Route::controller(App\Http\Controllers\Admin\Service\ServiceController::class)->group(function () {

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
            Route::get('/userCustomer', [App\Http\Controllers\Admin\User\UserCustomerSearchSelectController::class, 'selectSearch'])->name('userCustomer');
        });
    });
});
