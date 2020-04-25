<?php

Auth::routes(['register' => false]);

Route::group(['namespace' => 'Web'], function () {
    Route::get('/form-comments', 'FormCommentController@index')->name('form-comments');
    Route::post('/form-comments/store', 'FormCommentController@store')->name('form-comments.store');
    Route::post('/form-comments/ajax', 'FormCommentController@ajax')->name('form-comments.ajax');
    Route::get('/comments/json', 'CommentController@json')->name('json');
    Route::get('/calendars/json', 'CalendarController@json')->name('json');
    Route::get('/settings/json', 'SettingController@json')->name('json');
    Route::get('/programation', 'CalendarController@show')->name('programation');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Web'], function () {
    Route::get('/', 'IndexController@index')->name('home');

    Route::group(['as' => 'web.'], function () {

        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            Route::get('/', 'SettingController@index')->name('index');
            Route::post('/', 'SettingController@store')->name('store');
        });

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', 'UserController@index')->name('index');
            Route::get('/create', 'UserController@create')->name('create');
            Route::post('/store', 'UserController@store')->name('store');
            Route::get('/edit/{uid}', 'UserController@edit')->name('edit');
            Route::put('/update/{uid}', 'UserController@update')->name('update');
            Route::delete('/destroy/{uid}', 'UserController@destroy')->name('destroy');
        });

        Route::group(['prefix' => 'programs', 'as' => 'programs.'], function () {
            Route::get('/', 'ProgramController@index')->name('index');
            Route::get('/create', 'ProgramController@create')->name('create');
            Route::post('/store', 'ProgramController@store')->name('store');
            Route::get('/edit/{uid}', 'ProgramController@edit')->name('edit');
            Route::put('/update/{uid}', 'ProgramController@update')->name('update');
            Route::delete('/destroy/{uid}', 'ProgramController@destroy')->name('destroy');
        });

        Route::group(['prefix' => 'calendars', 'as' => 'calendars.'], function () {
            Route::get('/', 'CalendarController@index')->name('index');
            Route::get('/create', 'CalendarController@create')->name('create');
            Route::post('/store', 'CalendarController@store')->name('store');
            Route::get('/edit/{uid}', 'CalendarController@edit')->name('edit');
            Route::put('/update/{uid}', 'CalendarController@update')->name('update');
            Route::delete('/destroy/{uid}', 'CalendarController@destroy')->name('destroy');
        });

        Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
            Route::get('/', 'CommentController@index')->name('index');
            Route::delete('/destroy/{uid}', 'CommentController@destroy')->name('destroy');
        });
    });
});
