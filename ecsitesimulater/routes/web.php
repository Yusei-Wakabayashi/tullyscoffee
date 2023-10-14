<?php

use Illuminate\Support\Facades\Route;
use App\Models\Item;

Route::get('/', 'App\Http\Controllers\StartController@index');
//データベース内のアイテム名
Route::get('/getitems', 'App\Http\Controllers\StartController@getItems');
Route::get('/item/start', 'App\Http\Controllers\StartController@getItems');
Route::get('/item/search', 'App\Http\Controllers\StartController@searchItems');
Route::get('/item/world/{id}', 'App\Http\Controllers\StartController@selectWorld');
Route::get('/item/world/all', 'App\Http\Controllers\StartController@worldlist');
Route::get('/item/categoly/{id)', 'App\Http\Controllers\StartController@selectCategoly');
Route::get('/item/categoly/all', 'App\Http\Controllers\StartController@categolylist');
Route::get('/item/recipe', 'App\Http\Controllers\StartController@findItemid');

//Route::get('/{any?}', fn () => view('app'))->where('any', '.+');