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

Route::get('/', 'HomeController@index')->name('home');

Route::get('message/form/', 'MessageController@form')->name('message.form');

Route::get('message/edit/{id}', 'MessageController@edit')->name('message.edit');

Route::get('message/answer/{id}', 'MessageController@answerForm')->name('message.answer.form');

Route::post('message/answer/{id}', 'MessageController@answer')->name('message.answer');

Route::post('message/create', 'MessageController@create')->name('message.create');

Route::post('message/update/{id}', 'MessageController@update')->name('message.update');

Route::post('message/delete/{id}', 'MessageController@delete')->name('message.delete');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
