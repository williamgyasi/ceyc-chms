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

// Route content layout
Route::get('/', 'LayoutController@content');

// Route full layout
Route::get('full', 'LayoutController@full');

/**
 * Admin Resource Routes
 */
Route::resource('admin/cells', 'CellController');

Route::resource('admin/fellowships', 'FellowshipController');

Route::resource('admin/members', 'MemberController');

Route::resource('admin/departments', 'DepartmentController');

Route::resource('admin/services', 'ServiceController');

Route::resource('admin/roles', 'RoleController');

Route::resource('admin/users/user-roles', 'UserController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('giving/successful', 'GivingController@successful')->name('giving.successful');

Route::get('giving/error', 'GivingController@errorState')->name('giving.error');

Route::get('giving/complete', 'GivingController@completion')->name('giving.completion');

Route::post('giving', 'GivingController@store')->name('giving.store');

Route::get('giving', 'GivingController@showGivingForm')->name('giving.create');

Route::get('giving/{giving}/confirm', 'GivingController@confirm')->name('giving.confirm');

Route::get('payment/confirm', 'PaymentController@confirm')->name('payment.confirm');

Route::post('payment', 'PaymentController@store')->name('payment.store');

Route::get('payment', 'PaymentController@showForm')->name('payment.create');
