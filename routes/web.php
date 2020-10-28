<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/admin', 'AdminController@login');
Route::post('/admin', 'AdminController@postLogin')->name('admin.login');

Route::get('/home', function () {
    return view('home');
})->name('home');

// Admin

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {

// Categories

    Route::group([

        'prefix' => 'categories',
        'as' => 'categories.',

    ], function () {

        Route::get('/', 'CategoryController@index')->middleware('can:category-list')->name('index');

        Route::get('/create', 'CategoryController@create')->middleware('can:category-add')->name('create');

        Route::post('/store', 'CategoryController@store')->name('store');

        Route::get('/edit/{id}', 'CategoryController@edit')->middleware('can:category-edit')->name('edit');

        Route::post('/update/{id}', 'CategoryController@update')->name('update');

        Route::get('/delete/{id}', 'CategoryController@delete')->middleware('can:category-delete')->name('delete');

    });

// Menu

    Route::group([

        'prefix' => 'menus',
        'as' => 'menus.',

    ], function () {

        Route::get('/', 'MenuController@index')->middleware('can:category-list')->name('index');

        Route::get('/create', 'MenuController@create')->name('create');

        Route::post('/store', 'MenuController@store')->name('store');

        Route::get('/edit/{id}', 'MenuController@edit')->name('edit');

        Route::post('/update/{id}', 'MenuController@update')->name('update');

        Route::get('/delete/{id}', 'MenuController@delete')->name('delete');

    });

// Products

    Route::group([

        'prefix' => 'products',
        'as' => 'products.',

    ], function () {

        Route::get('/', 'ProductController@index')->name('index');

        Route::get('/create', 'ProductController@create')->name('create');

        Route::post('/store', 'ProductController@store')->name('store');

        Route::get('/edit/{id}', 'ProductController@edit')->name('edit');

        Route::post('/update/{id}', 'ProductController@update')->name('update');

        Route::get('/delete/{id}', 'ProductController@delete')->name('delete');

    });

// Slider

    Route::group([

        'prefix' => 'sliders',
        'as' => 'sliders.',

    ], function () {

        Route::get('/', 'SliderController@index')->name('index');

        Route::get('/create', 'SliderController@create')->name('create');

        Route::post('/store', 'SliderController@store')->name('store');

        Route::get('/edit/{id}', 'SliderController@edit')->name('edit');

        Route::post('/update/{id}', 'SliderController@update')->name('update');

        Route::get('/delete/{id}', 'SliderController@delete')->name('delete');

    });

// Settings

    Route::group([

        'prefix' => 'settings',
        'as' => 'settings.',

    ], function () {

        Route::get('/', 'SettingController@index')->name('index');

        Route::get('/create', 'SettingController@create')->name('create');

        Route::post('/store', 'SettingController@store')->name('store');

        Route::get('/edit/{id}', 'SettingController@edit')->name('edit');

        Route::post('/update/{id}', 'SettingController@update')->name('update');

        Route::get('/delete/{id}', 'SettingController@delete')->name('delete');

    });

// Users

    Route::group([

        'prefix' => 'users',
        'as' => 'users.',

    ], function () {

        Route::get('/', 'UserController@index')->name('index');

        Route::get('/create', 'UserController@create')->name('create');

        Route::post('/store', 'UserController@store')->name('store');

        Route::get('/edit/{id}', 'UserController@edit')->name('edit');

        Route::post('/update/{id}', 'UserController@update')->name('update');

        Route::get('/delete/{id}', 'UserController@delete')->name('delete');

    });

// Roles

    Route::group([

        'prefix' => 'roles',
        'as' => 'roles.',

    ], function () {

        Route::get('/', 'RoleController@index')->name('index');

        Route::get('/create', 'RoleController@create')->name('create');

        Route::post('/store', 'RoleController@store')->name('store');

        Route::get('/edit/{id}', 'RoleController@edit')->name('edit');

        Route::post('/update/{id}', 'RoleController@update')->name('update');

        // Route::get('/delete/{id}', 'RoleController@delete')->name('delete');

    });
// Permission
    Route::group([

        'prefix' => 'permissions',
        'as' => 'permissions.',

    ], function () {

        Route::get('/create', 'AdminPermissionController@createPermission')->name('create');

        Route::post('/store', 'AdminPermissionController@store')->name('store');

    });

});
