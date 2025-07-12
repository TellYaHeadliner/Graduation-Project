<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['roleCheck:Owner', 'hotelOwnerCheck'])->group(function () {
    Route::get('/dashboard/{hotel_id}', [App\Http\Controllers\Hotel\Dashboard\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data/{hotel_id}',  [App\Http\Controllers\Hotel\Dashboard\DashboardController::class, 'data'])->name('dashboard.data');

    Route::prefix('/hotel-rules')->as('hotel_rules.')->group(function () {
        Route::controller(App\Http\Controllers\Hotel\HotelRules\HotelRulesController::class)->group(function () {

            Route::get('/{hotel_id}', 'index')->name('index');

            Route::put('/{hotel_id}/sua', 'update')->name('update');
        });
    });

    Route::middleware(['checkHotelRule'])->group(function () {
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
        // Combo_Services
        Route::prefix('/combo-services')->as('combo_service.')->group(function () {
            Route::controller(App\Http\Controllers\Hotel\ComboService\ComboServiceController::class)->group(function () {

                Route::get('/{hotel_id}/{combo_id}/them', 'create')->name('create');
                Route::post('/{hotel_id}/{combo_id}/them', 'store')->name('store');

                Route::get('/{hotel_id}/{combo_id}', 'index')->name('index');
                Route::get('/{hotel_id}/sua/{combo_id}/{hotel_service_id}', 'edit')->name('edit');

                Route::put('/{hotel_id}/sua', 'update')->name('update');

                Route::delete('/{hotel_id}/xoa/{combo_id}/{hotel_service_id}', 'delete')->name('delete');
            });
        });
        // Room-types
        Route::prefix('/room-types')->as('room_type.')->group(function () {
            Route::controller(App\Http\Controllers\Hotel\RoomType\RoomTypeController::class)->group(function () {

                Route::get('/{hotel_id}/them', 'create')->name('create');
                Route::post('/{hotel_id}/them', 'store')->name('store');

                Route::get('/{hotel_id}', 'index')->name('index');
                Route::get('/{hotel_id}sua/{id}', 'edit')->name('edit');

                Route::put('/{hotel_id}/sua', 'update')->name('update');

                Route::delete('/{hotel_id}/xoa/{id}', 'delete')->name('delete');
            });
        });
        // Room-Type-Variants
        Route::prefix('/room-type-variants')->as('room_type_variant.')->group(function () {
            Route::controller(App\Http\Controllers\Hotel\RoomType\RoomTypeVariantController::class)->group(function () {

                Route::get('/{hotel_id}/{room_type_id}/them', 'create')->name('create');
                Route::post('/{hotel_id}/{room_type_id}/them', 'store')->name('store');

                Route::get('/{hotel_id}/{room_type_id}', 'index')->name('index');
                Route::get('/{hotel_id}/{room_type_id}sua/{id}', 'edit')->name('edit');

                Route::put('/{hotel_id}/{room_type_id}/sua', 'update')->name('update');

                Route::delete('/{hotel_id}/{room_type_id}/xoa/{id}', 'delete')->name('delete');
            });
        });
        // Rooms
        Route::prefix('/rooms')->as('room.')->group(function () {
            Route::controller(App\Http\Controllers\Hotel\Room\RoomController::class)->group(function () {

                Route::get('/{hotel_id}/{room_type_id}/them', 'create')->name('create');
                Route::post('/{hotel_id}/{room_type_id}/them', 'store')->name('store');

                Route::get('/{hotel_id}', 'index')->name('index');
                Route::get('/{hotel_id}/{room_type_id}/sua/{id}', 'edit')->name('edit');

                Route::put('/{hotel_id}/{room_type_id}/sua', 'update')->name('update');

                Route::delete('/{hotel_id}/{room_type_id}/xoa/{id}', 'delete')->name('delete');
            });
        });

        Route::prefix('/transactions')->as('transaction.')->group(function () {
            Route::controller(App\Http\Controllers\Hotel\Transaction\TransactionController::class)->group(function () {
                Route::get('/{hotel_id}', 'index')->name('index');
            });
        });
        Route::prefix('/bookings')->as('booking.')->group(function () {
            Route::controller(App\Http\Controllers\Hotel\Booking\BookingController::class)->group(function () {
                Route::get('/{hotel_id}', 'index')->name('index');
                Route::get('/{hotel_id}/sua/{id}', 'edit')->name('edit');

                Route::put('/{hotel_id}/sua', 'update')->name('update');
            });
        });

        Route::prefix('/search')->as('search.')->group(function () {
            Route::prefix('/select')->as('select.')->group(function () {
                Route::get('/{hotel_id}/hotel-services', [App\Http\Controllers\Hotel\HotelService\HotelServiceSearchSelectController::class, 'selectSearch'])->name('hotel_service');
            });
        });
    });
});
