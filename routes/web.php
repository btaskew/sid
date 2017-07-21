
<?php

Route::get('/', 'HomeController@index')->name('home');
Route::post('/notifications/{notification}/delete', 'HomeController@delete');
Route::post('/notifications/delete', 'HomeController@deleteAll');

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');


Route::get('/calls/create', 'CallController@create');
Route::get('/calls/{category}', 'CallController@index')->name('calls');
Route::get('/calls', function() {
  return redirect()->route('calls', ['category' => 'active']);
});
Route::post('/calls', 'CallController@store');
Route::get('/calls/{call}/edit', 'CallController@edit');
Route::post('/calls/{call}/edit', 'CallController@save');
