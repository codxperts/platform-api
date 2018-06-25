<?php

Route::group(['middleware' => 'web', 'prefix' => 'developer', 'namespace' => 'Modules\Developer\Http\Controllers'], function()
{
    Route::get('/', 'DeveloperController@index');
});
