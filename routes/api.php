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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');

    Route::get('save/{id}', 'DataController@store');
    Route::get('saves', 'DataController@show');
    Route::get('saved/check/{id}', 'DataController@check');
    Route::get('saved/delete/{id}', 'DataController@delete');

    // Route::get('closed', 'DataController@closed');
});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
// Route::get('open', 'DataController@open');

