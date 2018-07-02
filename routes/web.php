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




Auth::routes();

//Route::get('/dashboard', 'DashboardController@index');
//// Route::get('/system-management/{option}', 'SystemMgmtController@index');
//Route::get('/profile', 'ProfileController@index');

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('/', function () {
        if(Auth::user()->level == 1){
            return view('dashboard');
        } else {
            return view('sourcingHome');
        }
    });

    Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');
    Route::resource('user-management', 'UserManagementController');

    Route::post('customer-management/search', 'CustomerManagementController@search')->name('customer-management.search');
    Route::resource('customer-management', 'CustomerManagementController');

    Route::post('vendor-management/search', 'VendorManagementController@search')->name('vendor-management.search');
    Route::resource('vendor-management', 'VendorManagementController');

    Route::post('fish-management/search', 'FishManagementController@search')->name('fish-management.search');
    Route::resource('fish-management', 'FishManagementController');
    Route::get('avatars/{name}', 'FishManagementController@load');

});


//Route::group(['middleware' => ['web', 'checkuser:1']], function(){
//    Route::get('/', function () {
//        if(Auth::user()->level == 1){
//            return view('dashboard');
//        }
//    });
//
//    Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');
//    Route::resource('user-management', 'UserManagementController');
//});
//
//Route::group(['middleware' => ['web', 'checkuser:2']], function(){
//    Route::get('/', function () {
//        return view('sourcingHome');
//    })->middleware('auth');
//});

