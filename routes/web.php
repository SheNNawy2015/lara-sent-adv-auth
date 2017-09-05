<?php
// Routes

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['guest']], function() {

	// register
	Route::get('/register', 'RegisterController@register');
	Route::post('/register', 'RegisterController@postRegister');
	// login
	Route::get('/login', 'LoginController@login');
	Route::post('/login', 'LoginController@postlogin');

	// activation
	Route::get('/activate/{email}/{activationCode}', 'ActivationController@activate');

	// forgot password
	Route::get('forgot-password', 'ResetPasswordController@forgotPassword');
	Route::post('forgot-password', 'ResetPasswordController@postForgotPassword');
	// reset password
	Route::get('/reset/{email}/{resetCode}', 'ResetPasswordController@resetPassword');
	Route::post('/reset/{email}/{resetCode}', 'ResetPasswordController@postResetPassword');
});

// user middleware group
Route::group(['middleware' => ['user']], function() {
	// home
	Route::get('/home', 'HomeController@index');
});

// logout
Route::post('/logout', 'LoginController@logout');

// manager middleware group
Route::group(['middleware' => ['manager']], function () {
	
	Route::get('/mailing', 'MailController@index');
	Route::post('/mailing', 'MailController@sendMails');
});
