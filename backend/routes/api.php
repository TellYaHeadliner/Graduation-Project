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

Route::middleware('checkJWT')->group(function () {});


Route::controller(App\Http\Controllers\API\Auth\AuthController::class)
    ->prefix('/auth')
    ->as('auth.')
    ->group(function () {
        Route::post('/', 'login')->name('post');
        Route::post('/logout', 'logout')->name('logout');

        Route::get('/google/redirect', 'redirectToGoogle')->name('google.redirect');
        Route::get('/google/callback', 'handleGoogleCallback')->name('google.callback');

        Route::get('/facebook/redirect', 'redirectToFacebook')->name('facebook.redirect');
        Route::get('/facebook/callback', 'handleFacebookCallback')->name('facebook.callback');
    });
