<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AppController, AuthenticateController, ChannelController, NotificationController, UserController};

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

    Route::get('/', function () {
        return response()->json([
            'message' => 'Welcome to Vibbraneo API',
            'status' => 'success',
        ]);
    });

    Route::post('/login', [AuthenticateController::class, 'login']);


    Route::group([
        'middleware' => ['auth:api']
    ], function () {

        Route::post('/users/register', [UserController::class, 'store']);
        Route::get('/users/{user_id}', [UserController::class, 'show']);

        Route::post('/apps', [AppController::class, 'store']);
        Route::get('/apps/{app_id}', [AppController::class, 'show']);

        Route::get('/apps/{app_id}/{channel}/settings', [ChannelController::class, 'show']);
        Route::put('/apps/{app_id}/{channel}/settings', [ChannelController::class, 'edit']);
        Route::post('/apps/{app_id}/{channel}/settings', [ChannelController::class, 'store']);

        Route::post('/apps/{app_id}/{channel}/notification', [NotificationController::class, 'store']);
        Route::get( '/apps/{app_id}/{channel}/notifications', [NotificationController::class, 'index']);
        Route::get( '/apps/{app_id}/{channel}/notifications/{notification_id}', [NotificationController::class, 'show']);

    });


});
