<?php

Route::group(['middleware' => 'web', 'prefix' => 'customer', 'namespace' => 'Modules\Customer\Http\Controllers'], function()
{
    Route::get('/', 'CustomerController@index');

    Route::get('/redirect', 'LoginController@redirectToProvider');
    Route::get('/callback', 'LoginController@handleProviderCallback');

});
