<?php

use App\Domain\Authentication\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authentication'], function () {
    Route::post('register', [AuthenticationController::class, 'register']);
    Route::post('send-otp', [AuthenticationController::class, 'sendOPT']);
})
;

