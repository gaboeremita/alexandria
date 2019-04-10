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

Route::get('/', 'BooksController@index');

Auth::routes();

Route::get('/home', 'BooksController@index')->name('home');

Route::post('/books/{book}/borrow', 'BooksController@borrow');

Route::get('/books/bookfeeder', 'BooksController@bookfeeder');

Route::resource('/books', 'BooksController');

Route::get('/users/{user}', 'UserController@show');

Route::post('/users/return/{book}', 'UserController@returnBook');


