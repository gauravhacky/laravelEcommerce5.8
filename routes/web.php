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
Route::get('categories/{category_id}','IndexController@categoryDetail')->name('category.details');
Route::get('/get/product-price/','IndexController@getProductprice')->name('product.price');
Route::get('dynamic/fields/','IndexController@dynamicFields')->name('dynamic.fields');
Route::match(['get','post'],'/admin','AdminController@login');
#Add to cart Routes
Route::get('cart','ProductController@addTocart')->name('add.cart')->middleware('verified');
Route::post('add-to-cart-store','ProductController@addTocartStore')->name('add.cartStore');
Route::get('delete/cart/{id}','ProductController@deleteCartProduct')->name('delete.cart');
#Route for Login or Register
Route::get('login-register','UsersController@userLoginRegister')->name('user.loginregister');
Route::post('user-register','UsersController@userRegister')->name('user.register');
Route::post('user-login','UsersController@userLogin')->name('user.Login');
Route::get('user-logout','UsersController@userLogout')->name('user.logout');
#Route for middleware after front login
Route::group(['middleware'=>['FrontuserLogin']],function(){
Route::get('user-account','UsersController@userAccount')->name('user.account');
Route::get('change-password','UsersController@changePassword')->name('user.changePass');
Route::post('change-password-store','UsersController@changePasswordStore')->name('user.changePassStore');
Route::get('change-adddress','UsersController@changeAddress')->name('user.address');
Route::post('update-adddress','UsersController@updateAddress')->name('user.updateaddress');
Route::get('checkout','ProductController@checkout')->name('product.checkout');
Route::post('checkout/store','ProductController@checkoutStore')->name('checkout.store'); 
Route::get('order-review','ProductController@orderReview')->name('order.review');
Route::post('place-order','ProductController@placeOrder')->name('place.order');
});
//Update product Quantity
Route::get('cart/update-quantity/{id}/{quantity}','ProductController@updateCartquantity')->name('update.cartquantity');
#Apply Coupon Code
Route::post('cart/apply-coupon','ProductController@applyCoupon')->name('apply.coupon');

Auth::routes(['verify'=>true]);
Route::match(['get','post'],'/home','IndexController@home');

Route::group(['middleware' =>['auth']],function()
{
Route::match(['get','post'],'admin/dashboard','AdminController@dashboard');
#Category Routes
Route::get('list/category','CategoryController@listCategory')->name('list.category');
Route::get('add/category','CategoryController@addCategory')->name('add.category');
Route::get('edit/category/{id}','CategoryController@editCategory')->name('edit.category');
Route::post('update/category/{id}','CategoryController@updateCategory')->name('update.categories');
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
Route::post('/featuredproduct/status','ProductController@updateFeaturedStatus')->name('update.FeaturedStatus');
#Product Attribute
Route::get('/add/attribute/{id}','ProductController@addAttribute')->name('addAttribute.product');  
Route::post('store/attribute/{id}','ProductController@addAttributeStore')->name('addAttributeStore.product');
Route::post('edit/attribute/{id}','ProductController@editAttributeedit')->name('addAttributeedit.product');
Route::get('add/images/{id}','ProductController@addimages')->name('addAttributimages.product');
Route::post('store/images/{id}','ProductController@storeimages')->name('Attributimagesstore.product');
Route::get('delete/attribute/{id}','ProductController@deleteAttributeStore')->name('addAttributedelete.product');
Route::get('delete/productimg/{id}','ProductController@deleteproductImg')->name('imgdelete.product');
#Banner Routes
Route::get('/list/banners','ManageBannerController@bannerList')->name('list.banner');
Route::get('/add/banner','ManageBannerController@addBanner')->name('add.banner');
Route::get('/add/banner','ManageBannerCon troller@addBanner')->name('add.banner');
Route::get('/edit/banner/{id}','ManageBannerController@editBanner')->name('edit.banner');  
Route::post('/update/banner/{id}','ManageBannerController@updateBanner')->name('update.banner');
Route::post('/store/banner','ManageBannerController@storeBanner')->name('store.banner');
Route::post('/banner/status','ManageBannerController@updateBannerStatus')->name('update.Bannerstatus');
Route::get('delete/banner/{id}','ManageBannerController@deleteBanner')->name('delete.Banner');
#Coupons Controller
Route::get('admin/add/coupon','CouponsController@getCoupon')->name('get.coupon');
Route::get('admin/list/coupon','CouponsController@listCoupon')->name('list.coupon');
Route::post('admin/coupon/store','CouponsController@storeCoupon')->name('store.coupon'); 
Route::get('admin/coupon/edit/{id}','CouponsController@editCoupon')->name('edit.coupon'); 
Route::post('admin/coupon/update{id}','CouponsController@updateCoupon')->name('update.coupon'); 
Route::post('admin/coupon/status','CouponsController@updateCouponStatus')->name('update.couponstatus');
Route::get('/delete/coupon/{id}','CouponsController@deleteCouponStatus')->name('delete.coupons');

}); 

Route::get('/logout','AdminController@logout');
