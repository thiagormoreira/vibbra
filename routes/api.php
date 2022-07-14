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

Route::group([
    'prefix'     => 'v1',
], function () {

    Route::get('/', function (Request $request) {
        return response()->json([
            'message' => 'Welcome to Vibbraneo API',
            'status' => 'success',
        ]);
    });

    Route::post('/login', [\App\Http\Controllers\Authenticate::class, 'login']);


    Route::group([
        'middleware' => ['auth:api']
    ], function () {

        Route::post('/users/register', [\App\Http\Controllers\UserController::class, 'store']);
        Route::get('/users/{user_id}', [\App\Http\Controllers\UserController::class, 'show']);

        Route::post('/apps', [\App\Http\Controllers\AppController::class, 'store']);
        Route::get('/apps/{app_id}', [\App\Http\Controllers\AppController::class, 'show']);

        Route::get('/apps/{app}/webpushes/settings', [\App\Http\Controllers\WebPushController::class, 'show']);
        Route::put('/apps/{app}/{channel}/settings', [\App\Http\Controllers\WebPushController::class, 'edit']);

    });


});
