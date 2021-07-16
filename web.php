<?php

use Eve\App\Route;

Route::get('/', 'MainController@index');
Route::get('/board', 'BoardController@index');
Route::get('/view', 'BoardController@view');
Route::get('/password_lost', 'MainController@passwordLost');

if (__SESSION) {
    if ($_SESSION['user']->id === "admin") {
        Route::get('/admin', 'MainController@adminPage');
        Route::post('/userStop', 'UserController@userStop');
        Route::post('/userDel', 'UserController@userDel');
    }
    Route::get('/logout', 'UserController@logout');
    Route::get('/delete', 'BoardController@delete');
    Route::get('/write', 'BoardController@writePage');
    Route::post('/write', 'BoardController@writeProcess');
    Route::get('/modify', 'BoardController@modify');
    Route::post('/modify', 'BoardController@modifyProcess');
    Route::post('/recom', 'BoardController@recom');
    Route::post('/comAdd', 'BoardController@comAdd');
    Route::post('/pwChange', 'FindController@pwChange');
} else {
    Route::get('/login', 'MainController@login');
    Route::post('/loginCheck', 'UserController@loginCheck');
    Route::get('/register', 'MainController@register');
    Route::post('/registerCheck', 'UserController@registerCheck');
    Route::post('/idFind', 'FindController@idFind');
    Route::post('/pwFind', 'FindController@pwFind');
}