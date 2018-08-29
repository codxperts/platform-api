<?php

Route::group(['middleware' => 'web', 'prefix' => 'customer', 'namespace' => 'Modules\Customer\Http\Controllers'], function()
{


    //Route::get('/test', 'CustomerController@index');
    Route::get('/test/{invitation}', 'CustomerController@index');

    // Route::get('{uri}', 'CustomerController@index');

    Route::get('/redirect', 'LoginController@redirectToProvider');
    Route::get('/callback', 'LoginController@handleProviderCallback');

});
