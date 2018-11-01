<?php

Route::prefix('v1')->namespace('V1')->group(function () {

    Route::middleware('guest:api')->prefix('auth')->namespace('Auth')->group(function () {
        Route::post('login', 'AuthController@login');
    });

    Route::middleware('auth:api')->group(function () {
        Route::prefix('auth')->namespace('Auth')->group(function () {
            Route::delete('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');
            Route::get('me', 'AuthController@me');
        });

        Route::get('/notes', 'NoteController@index');
        Route::post('/notes', 'NoteController@store');
        Route::patch('/notes/{note}', 'NoteController@update');
        Route::delete('/notes/{note}', 'NoteController@destroy');

    });
});