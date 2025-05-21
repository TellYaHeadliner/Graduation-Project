<?php

use Illuminate\Support\Facades\Route;
use CKSource\CKFinderBridge\Controller\CKFinderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return "Yêu mẹ mày.net";
});

Route::prefix('ckfinder')->as('ckfinder.')->group(function () {
    Route::any('connector', [CKFinderController::class, 'requestAction'])->name('connector');
    Route::any('browser', [CKFinderController::class, 'browserAction'])->name('browser');
});