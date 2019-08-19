<?php

use Illuminate\Http\Request;

Route::get('projects', 'ProjectController@index');
Route::get('project/{slug}', 'ProjectController@show');
Route::post('project', 'ProjectController@store');
Route::delete('project/{slug}', 'ProjectController@destroy');

Route::get('developers', 'DeveloperController@index');