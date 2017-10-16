<?php

Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@index']);
Route::get('create', ['as' => 'create', 'uses' => 'HomeController@create']);
Route::get('iframe', ['as' => 'iframe', 'uses' => 'HomeController@iframe']);
Route::post('send/{id}', ['as' => 'send', 'uses' => 'HomeController@send']);
