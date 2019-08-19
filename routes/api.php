<?php

use Illuminate\Http\Request;
use App\ResponseFormatter;

Route::group(['middleware' => ['json.response']], function () {
    Route::get('projects', 'ProjectController@index');
    Route::get('project/{slug}', 'ProjectController@show');
    Route::post('project', 'ProjectController@store');
    Route::delete('project/{slug}', 'ProjectController@destroy');

    Route::get('developers', 'DeveloperController@index');

    Route::fallback(function() {
        return ResponseFormatter::errorMsg('Page Not Found.');
    });
});