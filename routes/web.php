
<?php

Route::get('/', 'HomeController@index')->name('home');
Route::post('/{notification}/delete', 'HomeController@delete');

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

Route::get('/calls/active-calls', 'CallController@activeCalls')->name('calls');
Route::get('/calls/closed-calls', 'CallController@closedCalls');
Route::get('/calls/assigned-calls', 'CallController@assignedCalls');
Route::get('/calls/closed-assigned-calls', 'CallController@closedAssignedCalls');

Route::get('/calls/create', 'CallController@create');
Route::post('/calls', 'CallController@store');
Route::get('/calls/{call}/edit', 'CallController@edit');
Route::post('/calls/{call}/edit', 'CallController@save');
