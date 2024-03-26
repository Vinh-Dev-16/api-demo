<?php

use App\Domain\Authentication\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authentication'], function () {
    Route::post('register', [AuthenticationController::class, 'register'])
        ->middleware(['throttle:5,1', 'no-token']);
    Route::post('send-otp', [AuthenticationController::class, 'sendOPT'])
    ->middleware(['throttle:5,1', 'no-token']);
    Route::post('verify-email', [AuthenticationController::class, 'verifyByEmail'],
    )->middleware(['no-token']);
    Route::post('login', [AuthenticationController::class, 'login'])
        ->middleware(['throttle:5,1']);
});
