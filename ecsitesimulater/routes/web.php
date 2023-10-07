<?php

use Illuminate\Support\Facades\Route;
use App\Models\Item;

//Route::get('/{any?}', fn () => view('app'))->where('any', '.+');
Route::get('/showUser', 'App\Http\Controllers\StartController@index');