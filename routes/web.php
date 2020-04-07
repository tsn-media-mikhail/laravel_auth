<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['status', 'auth']], function () {

   Route::get('/', 'DashboardController@dashboard')->name('admin.index');

   Route::group(['prefix' => 'user_managment', 'namespace' => 'UserManagment'], function (){
      Route::resource('/user', 'UserController', ['as' => 'admin.user_managment']);
   });
});
