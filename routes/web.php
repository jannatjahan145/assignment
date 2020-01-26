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
    return view('auth.login');
});
Route::resource('employee', 'EmployeeController');
Route::resource('employee-info', 'EmployeeInfoController');


Route::get('vuejs/autocomplete/search', 'EmployeeController@autocompleteSearch');
