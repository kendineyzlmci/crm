<?php

Auth::routes();

Route::group(['prefix' => '/', 'namespace' => 'Backend', 'middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name('home');

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/list', 'UserController@index')->name('list');
        Route::get('/add', 'UserController@add')->name('add');
        Route::post('/create', 'UserController@store')->name('create');
        Route::post('/update/{id}', 'UserController@update')->name('update');
        Route::get('/detail/{id}', 'UserController@detail')->name('detail');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit');
        Route::get('/delete/{id}', 'UserController@destroy')->name('delete');
    });

    Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function () {
        Route::get('/list', 'TaskController@index')->name('list');
        Route::get('/create', 'TaskController@create')->name('create');
        Route::post('/store', 'TaskController@store')->name('store');
        Route::get('/show/{id}', 'TaskController@show')->name('show');
        Route::get('/edit/{id}', 'TaskController@edit')->name('edit');
        Route::post('/update/{id}', 'TaskController@update')->name('update');
        Route::get('/destroy/{id}', 'TaskController@destroy')->name('destroy');
    });

    Route::group(['prefix'=>'customers','as'=>'customers.'],function (){
       Route::get('/list','CustomerController@index')->name('list');
        Route::get('/create', 'CustomerController@create')->name('create');
        Route::post('/store', 'CustomerController@store')->name('store');
        Route::get('/show/{id}', 'CustomerController@show')->name('show');
        Route::get('/edit/{id}', 'CustomerController@edit')->name('edit');
        Route::post('/update/{id}', 'CustomerController@update')->name('update');
        Route::get('/destroy/{id}', 'CustomerController@destroy')->name('destroy');
    });

    Route::group(['prefix'=>'comments','as'=>'comments.'],function (){

        Route::post('/store','TaskCommentsController@store')->name('store');
        Route::post('/update/{id}', 'TaskCommentsController@update')->name('update');
        Route::get('/destroy/{id}','TaskCommentsController@destroy')->name('destroy');
        Route::get('/like/{id}','TaskCommentsController@like')->name('like');

    });

    Route::group(['prefix'=>'files','as'=>'files.'],function (){
       Route::post('/store','TaskFilesController@store')->name('store');
       Route::post('/update','TaskFilesController@update')->name('update');
       Route::get('/destroy/{id}','TaskFilesController@destroy')->name('destroy');
    });

    Route::group(['prefix'=>'domains','as'=>'domains.'],function (){
       Route::get('/list','DomainController@index')->name('list');
       Route::get('/create','DomainController@create')->name('create');
       Route::post('/store','DomainController@store')->name('store');
       Route::get('/show/{id}','DomainController@show')->name('show');
       Route::get('/edit/{id}','DomainController@edit')->name('edit');
       Route::post('/update/{id}','DomainController@update')->name('update');
       Route::get('/destroy/{id}','DomainController@destroy')->name('destroy');
    });

    Route::group(['prefix'=>'domaincomments','as'=>'domaincomments.'],function (){

        Route::post('/store','DomainCommentsController@store')->name('store');
        Route::post('/update/{id}', 'DomainCommentsController@update')->name('update');
        Route::get('/destroy/{id}','DomainCommentsController@destroy')->name('destroy');
        Route::get('/like/{id}','DomainCommentsController@like')->name('like');

    });

    Route::group(['prefix'=>'domainfiles','as'=>'domainfiles.'],function (){
        Route::post('/store','DomainFilesController@store')->name('store');
        Route::post('/update','DomainFilesController@update')->name('update');
        Route::get('/destroy/{id}','DomainFilesController@destroy')->name('destroy');
    });

});

