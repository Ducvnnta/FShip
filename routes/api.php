<?php

use App\Http\Controllers\API\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

View::make('welcome');

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
Route::group(['namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1', 'namespace' => 'V1'], function () {
        Route::get('/list', 'UserController@getListAdminUser');
    });
    Route::group(['prefix' => 'auth'], function () {
        //resgister
        Route::post('/register-be', [AuthController::class, 'registerBE']);
        // Route::post('login', [AuthController::class, 'login']);
    });


    // Route::post('signup', 'AuthController@register');
    // Route::post('login', 'AuthController@login');
    // Route::group(['middleware' => 'jwt.auth'], function () {
    //     Route::get('auth', 'AuthController@user');
    //     Route::post('logout', 'AuthController@logout');
    // });
    // Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refresh');

});

