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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//login
Route::group(['namespace' => 'Admin'], function () {
    Route::get('login', 'LoginController@login');

});


//common  'middleware' => 'ValidateToken'
Route::group(['namespace' => 'Admin'], function () {

    Route::get('manager/list', 'ManagerController@managerList');
    Route::post('manager/create', 'ManagerController@login');
    Route::put('manager/update', 'ManagerController@login');
    Route::delete('manager/delete', 'ManagerController@login');

    Route::get('menu/list', 'MenuController@login');
    Route::post('menu/create', 'MenuController@login');
    Route::put('menu/update', 'MenuController@login');
    Route::delete('menu/delete', 'MenuController@login');

    Route::get('nav/list', 'NavigationController@login');
    Route::post('nav/create', 'NavigationController@login');
    Route::put('nav/update', 'NavigationController@login');
    Route::delete('nav/delete', 'NavigationController@login');

    Route::get('slide/list', 'SlideShowController@login');
    Route::post('slide/create', 'SlideShowController@login');
    Route::put('slide/update', 'SlideShowController@login');
    Route::delete('slide/delete', 'SlideShowController@login');

    Route::get('system/list', 'SystemController@login');
    Route::post('system/create', 'SystemController@login');
    Route::put('system/update', 'SystemController@login');
    Route::delete('system/delete', 'SystemController@login');

    Route::get('user/list', 'UsersController@login');
    Route::post('user/create', 'UsersController@login');
    Route::put('user/update', 'UsersController@login');
    Route::delete('user/delete', 'UsersController@login');

});
