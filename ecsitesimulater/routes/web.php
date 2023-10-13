<?php

use Illuminate\Support\Facades\Route;
use App\Models\Item;

Route::get('/', 'App\Http\Controllers\StartController@index');
//データベース内のアイテム名
Route::get('/getitems', 'App\Http\Controllers\StartController@getItems');

//Route::get('/{any?}', fn () => view('app'))->where('any', '.+');