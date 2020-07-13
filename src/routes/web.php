<?php

Route::group(array('namespace' => 'Codificar\Generic\Http\Controllers'), function () {

    Route::group(['prefix' => 'libs/generic', 'middleware' => 'auth.provider_api:api'], function () {

        Route::post('/report', 'GenericController@getGenericReport');
    
        Route::post('/add', 'GenericController@addWithDraw');
    });

});
