<?php

use App\Domain\Authentication\Controllers\AuthenticationController;
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

require base_path('app/Domain/Authentication/Routes/api.php');
require base_path('app/Domain/Admin/Product/Routes/api.php');
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::post('register', [AuthenticationController::class, 'register']);
