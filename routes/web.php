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
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/create/{id}','CitiesController@create')->name('createcities');
Route::get('/create/{id}','AreasController@create')->name('createareas');
Route::get('/create/{id}','UsersController@create')->name('changepassword');

Route::resource('LabourDetails', 'LabourDetailsController');
Route::resource('WorkDetails', 'WorkDetailsController');
Route::resource('LabourAddresses', 'LabourAddressesController');
Route::resource('WorkAddresses', 'WorkAddressesController');
Route::resource('LabourTypes', 'LabourTypesController');
Route::resource('WorkTypes', 'WorkTypesController');
Route::resource('Cities', 'CitiesController');
Route::resource('States', 'StatesController');
Route::resource('Areas', 'AreasController', ['except' => ['create']]);
Route::resource('Users', 'UsersController', ['except' => ['create']]);

Route::get('/findcity','StatesController@findcity');
Route::get('/findarea','StatesController@findarea');
Route::get('/aboutus','StatesController@aboutus')->name('aboutus');
Route::get('labour/selectarea','LabourDetailsController@selectarea')->name('labourselect');
Route::get('work/selectarea','WorkDetailsController@selectarea')->name('workselect');

Route::get('/selectrole','UsersController@selectrole')->name('selectrole');