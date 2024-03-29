<?php

namespace App\Domain\Admin\Product\Routes;

use App\Domain\Admin\Product\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'product'], function () {
    Route::get('list', [ProductController::class, 'listProduct']);
    Route::get('detail', [ProductController::class, 'detailProduct']);
})->middleware(['auth:api']);