<?php

Route::group(['middleware' => 'web', 'prefix' => 'developer', 'namespace' => 'Modules\Developer\Http\Controllers'], function()
{
    Route::get('/', 'DeveloperController@index');
});

Route::group(
    [
        'middleware' => ['api', 'before' => 'jwt-auth'],
        'prefix' => 'api/developer',
        'namespace' => 'Modules\Developer\Http\Controllers'
    ],
    function () {

        Route::get('status', function(Request $request){ return auth()->user(); });

        Route::post('invite', 'DeveloperController@inviteToFriend');

        Route::resource(
            '/invitation',
            'InvitationController',
            ['except' => ['edit', 'create']]
        );
    }
);