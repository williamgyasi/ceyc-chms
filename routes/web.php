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

Route::resource('payments', 'PaymentController');

Route::get('payments/{pay}/process', 'PaymentController@process')->name('payments.process');

Route::get('payments/confirmation/{response}', 'PaymentController@confirm')->name('payments.confirm');