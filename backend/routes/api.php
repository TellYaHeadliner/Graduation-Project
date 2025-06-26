<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('checkJWT')->group(function () {
    Route::prefix('/users')->as('user.')->group(function () {
        Route::controller(App\Http\Controllers\API\User\UserController::class)->group(function () {
            Route::get('/user-info', 'userInfo')->name('info');
        });
    });
    Route::controller(App\Http\Controllers\API\Hotel\HotelController::class)
        ->prefix('/hotels')
        ->as('hotel.')
        ->group(function () {
            Route::post('/register-hotel', 'registerHotel')->name('registerHotel');
    });
    Route::controller(App\Http\Controllers\API\Transaction\TransactionController::class)
        ->prefix('/transactions')
        ->as('transaction.')
        ->group(function () {
            Route::post('/create-booking', 'create_booking')->name('create_booking');
            Route::get('/callback-vnpay', 'callback_vnpay')->name('callback_vnpay');
    });
});


Route::controller(App\Http\Controllers\API\Auth\AuthController::class)
    ->prefix('/auth')
    ->as('auth.')
    ->group(function () {
        Route::post('/', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');

        Route::post('/register', 'register')->name('register');

        Route::get('/google/redirect', 'redirectToGoogle')->name('google.redirect');
        Route::get('/google/callback', 'handleGoogleCallback')->name('google.callback');

        Route::get('/facebook/redirect', 'redirectToFacebook')->name('facebook.redirect');
        Route::get('/facebook/callback', 'handleFacebookCallback')->name('facebook.callback');
        Route::get('/social-callback/{id}/{status}', 'socialCallback')->name('social_callback');
    });

Route::controller(App\Http\Controllers\API\Hotel\HotelController::class)
    ->prefix('/hotels')
    ->as('hotel.')
    ->group(function () {
        Route::get('/hotel-seasons/{name?}', 'listHotelSeasons')->name('listHotelSeasons');
        Route::get('/detail-hotel/{id?}', 'detailHotel')->name('detailHotel');
    });

Route::controller(App\Http\Controllers\API\RoomType\RoomTypeController::class)
    ->prefix('/room-types')
    ->as('room_type.')
    ->group(function () {
        Route::get('/{hotel_id?}/{check_in?}/{check_out?}/{guest?}/{children?}/{room_quantity?}', 'getRoomTypeHotel')->name('getRoomTypeHotel');
    });
