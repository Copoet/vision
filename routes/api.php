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
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
});


//common
Route::group(['namespace' => 'Admin', 'middleware' => 'ValidateToken'], function () {


    Route::get('manager/list', 'ManagerController@managerList');
    Route::get('manager/info/{id}', 'ManagerController@managerInfo');
    Route::post('manager/create', 'ManagerController@createManager');
    Route::put('manager/update/{id}', 'ManagerController@updateManager');
    Route::delete('manager/delete/{id}', 'ManagerController@delManager');

    Route::get('menu/list', 'MenuController@menuList');
    Route::get('menu/info/{id}', 'MenuController@menuInfo');
    Route::any('menu/tree', 'MenuController@menuTree');
    Route::post('menu/create', 'MenuController@createMenu');
    Route::put('menu/update/{id}', 'MenuController@updateMenu');
    Route::delete('menu/delete/{id}', 'MenuController@delMenu');
    Route::any('menu/side_menu', 'MenuController@sideMenu');


    Route::get('system/list', 'SystemController@systemList');
    Route::get('system/info/{id}', 'SystemController@systemInfo');
    Route::post('system/create', 'SystemController@createSystem');
    Route::put('system/update/{id}', 'SystemController@updateSystem');
    Route::delete('system/delete/{id}', 'SystemController@delSystem');

    Route::get('nav/list', 'NavigationController@navigationList');
    Route::get('nav/info/{id}', 'NavigationController@navigationInfo');
    Route::post('nav/create', 'NavigationController@createNavigation');
    Route::put('nav/update/{id}', 'NavigationController@updateNavigation');
    Route::delete('nav/delete/{id}', 'NavigationController@delNavigation');

    Route::get('slide/list', 'SlideShowController@slideList');
    Route::get('slide/info/{id}', 'SlideShowController@slideInfo');
    Route::post('slide/create', 'SlideShowController@createSlide');
    Route::put('slide/update/{id}', 'SlideShowController@updateSlide');
    Route::delete('slide/delete/{id}', 'SlideShowController@delSlide');


    Route::get('user/list', 'UserController@userList');
    Route::post('user/create', 'UserController@createUser');
    Route::put('user/update/{id}', 'UserController@updateUser');
    Route::delete('user/delete/{id}', 'UserController@delUser');


    Route::get('stock/list', 'StockController@userList');
    Route::post('stock/create', 'StockController@createUser');
    Route::put('stock/update/{id}', 'StockController@updateUser');
    Route::delete('stock/delete/{id}', 'StockController@delUser');

    Route::get('article/list', 'ArticleController@articleList');
    Route::get('article/info/{id}', 'ArticleController@articleInfo');
    Route::post('article/create', 'ArticleController@createArticle');
    Route::put('article/update/{id}', 'ArticleController@updateArticle');
    Route::delete('article/delete/{id}', 'ArticleController@delArticle');

    Route::get('article/sort/list', 'ArticleSortController@articleSortList');
    Route::get('article/sort/info/{id}', 'ArticleSortController@articleSortInfo');
    Route::post('article/sort/create', 'ArticleSortController@createArticleSort');
    Route::put('article/sort//update/{id}', 'ArticleSortController@updateArticleSort');
    Route::delete('article/sort/delete/{id}', 'ArticleSortController@delArticleSort');
    Route::get('article/sort/tree', 'ArticleSortController@getSortTree');

    Route::get('email/list', 'EmailController@emailList');
    Route::get('email/info/{id}', 'EmailController@emailInfo');
    Route::post('email/create', 'EmailController@createEmail');
    Route::put('email/update/{id}', 'EmailController@updateEmail');
    Route::delete('email/delete/{id}', 'EmailController@delEmail');

    Route::get('email_log/list', 'EmailLogController@emailLogList');
    Route::post('email_log/create', 'EmailLogController@createEmailLog');
    Route::put('email_log/update/{id}', 'EmailLogController@updateEmailLog');
    Route::delete('email_log/delete/{id}', 'EmailLogController@delEmailLog');

    Route::get('email_template/list', 'EmailTemplateController@templateList');
    Route::get('email_template/info/{id}', 'EmailTemplateController@templateInfo');
    Route::post('email_template/create', 'EmailTemplateController@createTemplate');
    Route::put('email_template/update/{id}', 'EmailTemplateController@updateTemplate');
    Route::delete('email_template/delete/{id}', 'EmailTemplateController@delTemplate');


    Route::get('auth_rule/list', 'AuthRuleController@list');
    Route::post('auth_rule/create', 'AuthRuleController@create');
    Route::put('auth_rule/update/{id}', 'AuthRuleController@update');
    Route::delete('auth_rule/delete/{id}', 'AuthRuleController@delete');

    Route::get('auth_group_access/list', 'AuthGroupAccessController@list');
    Route::post('auth_group_access/create', 'AuthGroupAccessController@create');
    Route::put('auth_group_access/update/{id}', 'AuthGroupAccessController@update');
    Route::delete('auth_group_access/delete/{id}', 'AuthGroupAccessController@delete');

    Route::get('auth_role_rule/list', 'AuthRoleRuleController@list');
    Route::post('auth_role_rule/create', 'AuthRoleRuleController@create');
    Route::put('auth_role_rule/update/{id}', 'AuthRoleRuleController@update');
    Route::delete('auth_role_rule/delete/{id}', 'AuthRoleRuleController@delete');

    Route::get('auth_manager/list', 'AuthManagerGroupController@list');
    Route::post('auth_manager/create', 'AuthManagerGroupController@create');
    Route::put('auth_manager/update/{id}', 'AuthManagerGroupController@update');
    Route::delete('auth_manager/delete/{id}', 'AuthManagerGroupController@delete');


});
