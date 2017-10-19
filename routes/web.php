<?php

Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@index']);
Route::get('create', ['as' => 'create', 'uses' => 'HomeController@create']);
Route::post('save', ['as' => 'save', 'uses' => 'HomeController@save']);
Route::get('i/{hash}', ['as' => 'iframe', 'uses' => 'HomeController@iframe']);
Route::post('send/{hash}', ['as' => 'send', 'uses' => 'HomeController@send']);

Route::get('about', ['as' => 'about', 'uses' => 'HomeController@about']);
