<?php

Route::group(['middleware' => 'web', 'prefix' => 'manager', 'namespace' => 'Modules\Manager\Http\Controllers'], function()
{
    Route::get('/', 'ManagerController@index');
});
