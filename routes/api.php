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

Route::middleware('auth:api')->put('user/{user}/online', 'frontEnd\realTime\UserOnlineController');
Route::middleware('auth:api')->put('user/{user}/offline', 'frontEnd\realTime\UserOfflineController');

// Route::apiResource('/blogs', 'BlogsController');
// Route::apiResource('/events', 'EventsController');
// Route::apiResource('/groups', 'GroupsController');
// Route::apiResource('/users', 'API\UserController');

// Route::get('/signup', 'API\UserController@signup');
