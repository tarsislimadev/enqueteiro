<?php

Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@index']);
Route::get('about', ['as' => 'about', 'uses' => 'HomeController@about']);
Route::get('clear', ['as' => 'clear', 'uses' => 'HomeController@clear']);

Route::get('create', ['as' => 'create', 'uses' => 'FormsController@create']);
Route::post('save', ['as' => 'save', 'uses' => 'FormsController@save']);
Route::get('i/{hash}', ['as' => 'iframe', 'uses' => 'FormsController@iframe']);
Route::get('f/{hash}', ['as' => 'form', 'uses' => 'FormsController@form']);
Route::get('v/{hash}', ['as' => 'view', 'uses' => 'FormsController@view']);
Route::post('send/{hash}', ['as' => 'send', 'uses' => 'FormsController@send']);

