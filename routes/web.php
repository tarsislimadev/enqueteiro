<?php

Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@index']);
Route::get('create', ['as' => 'create', 'uses' => 'HomeController@create']);
Route::post('save', ['as' => 'save', 'uses' => 'HomeController@save']);
Route::get('iframe', ['as' => 'iframe', 'uses' => 'HomeController@iframe']);
Route::post('send', ['as' => 'send', 'uses' => 'HomeController@send']);
