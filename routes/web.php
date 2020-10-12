<?php

use Illuminate\Support\Facades\Route;

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

// CRUD post
Route::post('/store-post', 'PostController@store');
Route::get('/get-post', 'PostController@index');
Route::post('/edit-post', 'PostController@edit');
Route::post('/delete-post', 'PostController@destroy');

// Upload Image
Route::post('/idiary/upload', 'PostController@uploadImage');

// User
Route::post('/add-user', 'UserController@store');
Route::post('/idiary/login', 'UserController@login');

// login and logout
Route::get('/', 'UserController@index');
Route::get('/logout', 'UserController@logout');
Route::any('{slug}', 'UserController@index');

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::any('{slug}', function(){
//     return view('welcome');
// });