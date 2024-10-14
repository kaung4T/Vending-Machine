<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('jwt.verify')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('logout', [ApiAuthController::class, 'logout']);
    Route::post('refresh', [ApiAuthController::class, 'refresh']);
    Route::post('user', [ApiAuthController::class, 'user']);

});

Route::middleware('jwt.verify')->get('/v1/products', [ApiController::class, 'apiProductAll']);
Route::middleware('jwt.verify')->get('/v1/products/{id}', [ApiController::class, 'apiProductSingle']);
Route::middleware('jwt.verify')->post('/v1/products', [ApiController::class, 'apiProductStore']);
Route::middleware('jwt.verify')->put('/v1/products/update/{id}', [ApiController::class, 'apiProductUpdate']);
Route::middleware('jwt.verify')->delete('/v1/products/delete/{id}', [ApiController::class, 'apiProductDestroy']);
