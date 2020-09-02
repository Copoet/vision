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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//login
Route::group(['namespace' => 'Admin'], function () {
    Route::any('login', 'LoginController@login');

});


//common
Route::group(['namespace' => 'Admin', 'middleware' => 'ValidateToken'], function () {

    Route::get('manager/list', 'ManagerController@managerList');
    Route::post('manager/create', 'ManagerController@createManager');
    Route::put('manager/update', 'ManagerController@updateManager');
    Route::delete('manager/delete', 'ManagerController@delManager');

    Route::get('menu/list', 'MenuController@menuList');
    Route::get('menu/tree', 'MenuController@menuTree');
    Route::post('menu/create', 'MenuController@createMenu');
    Route::put('menu/update', 'MenuController@updateMenu');
    Route::delete('menu/delete', 'MenuController@delMenu');
    Route::get('menu/side_menu', 'MenuController@sideMenu');


    Route::get('system/list', 'SystemController@systemList');
    Route::post('system/create', 'SystemController@createSystem');
    Route::put('system/update', 'SystemController@updateSystem');
    Route::delete('system/delete', 'SystemController@delSystem');

    Route::get('nav/list', 'NavigationController@login');
    Route::post('nav/create', 'NavigationController@login');
    Route::put('nav/update', 'NavigationController@login');
    Route::delete('nav/delete', 'NavigationController@login');

    Route::get('slide/list', 'SlideShowController@login');
    Route::post('slide/create', 'SlideShowController@login');
    Route::put('slide/update', 'SlideShowController@login');
    Route::delete('slide/delete', 'SlideShowController@login');


    Route::get('user/list', 'UserController@userList');
    Route::post('user/create', 'UserController@createUser');
    Route::put('user/update', 'UserController@updateUser');
    Route::delete('user/delete', 'UserController@delUser');


    Route::get('stock/list', 'StockController@userList');
    Route::post('stock/create', 'StockController@createUser');
    Route::put('stock/update', 'StockController@updateUser');
    Route::delete('stock/delete', 'StockController@delUser');

});
