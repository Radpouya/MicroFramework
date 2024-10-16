<?php
use App\Core\Routing\Route;

Route::get('/', ['HomeController', 'index']);

Route::get('/todo/list', 'TodoController@list');
Route::get('/todo/add', 'TodoController@add');
Route::get('/todo/remove', 'TodoController@remove');

Route::get('/archive', 'ArchiveController@index');
Route::get('/archive/articles', 'ArchiveController@articles');
Route::get('/archive/products', 'ArchiveController@products');
