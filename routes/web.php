<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('chat', 'ChatController@chat');
Route::post('send','ChatController@send');
Route::post('getOldMessage','ChatController@getOldMessage');
Route::post('saveToSession','ChatController@saveToSession');
Route::post('deleteSession', 'ChatController@deleteSession');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
