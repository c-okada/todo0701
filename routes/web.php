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

//タスクフォルダ
Route::get('/folders/{id}/tasks','TaskController@index')->name('tasks.index');

//フォルダ作成機能
Route::get('/folders/create','FolderController@showCreateForm')->name('folders.create');
Route::post('/folders/create','FolderController@create');