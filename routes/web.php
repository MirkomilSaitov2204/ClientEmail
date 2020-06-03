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
})->name('main');

Auth::routes();

Route::prefix('manage')->middleware('role:administrator|client|editor|operator')->group(function(){
    Route::get('/', 'Admin\ManageController@index');
    Route::get('/dashboard', 'Admin\ManageController@dashboard')->name('admin.dashboard');

    // User
    Route::get('/user', 'UserController@index')->name('user.index')->middleware('can:create-users');
    Route::get('/user/create', 'UserController@create')->name('user.create')->middleware('can:create-users');
    Route::post('/user/store', 'UserController@store')->name('user.store')->middleware('can:create-users');
    Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit')->middleware('can:update-users,id');
    Route::put('/user/update/{id}', 'UserController@update')->name('user.update')->middleware('can:update-users,id');
    Route::get('/user/show/{id}', 'UserController@show')->name('user.show')->middleware('can:read-users,id');
    Route::get('/user/destroy/{id}', 'UserController@destroy')->name('user.destroy')->middleware('can:delete-users,id');

    Route::resource('/role', 'Admin\RoleController', ['except'=>'destroy']);
    Route::resource('/permission', 'Admin\PermissionController', ['except'=>'destroy']);

    // Post
    Route::get('/products', 'ProductController@index')->name('products.index');
    Route::get('/products/{id}', 'ProductController@show')->name('products.show');
    Route::post('/products', 'ProductController@send')->name('products.send');


});

Route::get('/products', 'HomeController@products')->name('products');

Route::get('/cart', "HomeController@index")->name('cart.index');
Route::post('/cart', "HomeController@store")->name('cart.store');

Route::post('/order', "HomeController@OrderStore")->name('order.store')->middleware('auth');

