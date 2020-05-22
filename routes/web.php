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
Route::get('product/details/{id}','IndexController@productDetail')->name('product.details');
Route::get('dynamic/fields/','IndexController@dynamicFields')->name('dynamic.fields');
Route::match(['get','post'],'/admin','AdminController@login');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' =>['auth']],function()
{
Route::match(['get','post'],'admin/dashboard','AdminController@dashboard');
#Category Routes
Route::get('list/category','CategoryController@listCategory')->name('list.category');
Route::get('add/category','CategoryController@addCategory')->name('add.category');
Route::get('edit/category/{id}','CategoryController@editCategory')->name('edit.category');
Route::post('update/category/{id}','CategoryController@updateCategory')->name('update.category');
Route::post('store/category','CategoryController@storeCategory')->name('store.category');
Route::get('delete/category/{id}','CategoryController@deleteCategory')->name('delete.category');
Route::post('/category/status','CategoryController@updatecategorystatus')->name('update.category');
#Product Routes
Route::get('/add/product','ProductController@addproduct')->name('add.product');
Route::get('/product/list','ProductController@productList')->name('list.product');
Route::post('store/products','ProductController@storeproduct')->name('stores.product');
Route::get('edit/product/{id}','ProductController@editproduct')->name('edit.product');
Route::post('edit/product/{id}','ProductController@updateproduct')->name('update.product');
Route::get('delete/product/{id}','ProductController@deleteproduct')->name('delete.product');
Route::post('/product/status','ProductController@updateStatus')->name('update.status');
#Product Attribute
Route::get('/add/attribute/{id}','ProductController@addAttribute')->name('addAttribute.product');  
Route::post('store/attribute/{id}','ProductController@addAttributeStore')->name('addAttributeStore.product');
#Banner Routes
Route::get('/list/banners','ManageBannerController@bannerList')->name('list.banner');
Route::get('/add/banner','ManageBannerController@addBanner')->name('add.banner');
Route::get('/add/banner','ManageBannerController@addBanner')->name('add.banner');
Route::get('/edit/banner/{id}','ManageBannerController@editBanner')->name('edit.banner');  
Route::post('/update/banner/{id}','ManageBannerController@updateBanner')->name('update.banner');
Route::post('/store/banner','ManageBannerController@storeBanner')->name('store.banner');
Route::post('/banner/status','ManageBannerController@updateBannerStatus')->name('update.Bannerstatus');
Route::get('delete/banner/{id}','ManageBannerController@deleteBanner')->name('delete.Banner');
}); 
Route::get('/logout','AdminController@logout');
