<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('nada', function() { return 'nada';});

/* Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
}); */

/* Route::get('users', '\App\Http\Controllers\API\UserController@index'); */
Route::middleware('auth:api')->get('/users', '\App\Http\Controllers\API\UserController@index');
Route::middleware('auth:api')->get('/departments', '\App\Http\Controllers\API\DepartmentController@index');
Route::middleware('auth:api')->get('/activities', '\App\Http\Controllers\API\ActivitiesController@index');
Route::middleware('auth:api')->get('/places', '\App\Http\Controllers\API\PlaceController@index');

Route::middleware('auth:api')->get('/tasks', '\App\Http\Controllers\API\TaskController@index');