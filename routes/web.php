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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::match(['get','post'],'/','IndexController@index');
Route::match(['get','post'],'/admin','AdminController@login');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' =>['auth']],function()
{
Route::match(['get','post'],'admin/dashboard','AdminController@dashboard');
Route::get('/add/product','ProductController@addproduct')->name('add.product');
Route::get('/product/list','ProductController@productList')->name('list.product');
Route::post('store/products','ProductController@storeproduct')->name('stores.product');
Route::get('edit/product/{id}','ProductController@editproduct')->name('edit.product');
Route::post('edit/product/{id}','ProductController@updateproduct')->name('update.product');
}); 
Route::get('/logout','AdminController@logout');
