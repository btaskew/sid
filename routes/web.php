
<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

Route::get('/calls/active-calls', 'CallController@index');
Route::get('/calls/create', 'CallController@create');
Route::post('/calls', 'CallController@store');
Route::get('/calls/{call}/edit', 'CallController@edit');
Route::post('/calls/{call}/edit', 'CallController@save');
