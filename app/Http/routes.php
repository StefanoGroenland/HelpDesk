<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//loginscherm
Route::get('/', function () {
    return view('auth/welcome');
});
//klantdashboard scherm
Route::get('/dashboard',['middleware' => 'auth', function () {
    return view('dashboard');
}]);
//admin dashboard scherm
Route::get('/admindashboard', 'AdminController@showDashboard');

//bugchatscherm
Route::get('/bugchat',['middleware' => 'auth', function () {
    return view('bugchat');
}]);
//bugmuteren scherm
Route::get('/bugmuteren',['middleware' => 'auth', function () {
    return view('bugmuteren');
}]);
//bugoverzicht scherm
Route::get('/bugoverzicht',['middleware' => 'auth', function () {
    return view('bugoverzicht');
}]);
//medewerker muteren scherm
Route::get('/medewerkermuteren', 'AdminController@showMwMuteren');
//profiel scherm
Route::get('/profiel',['middleware' => 'auth', function () {
    return view('profiel');
}]);
//projectmuteren scherm
Route::get('/projectmuteren',['middleware' => 'auth', function () {
    return view('projectmuteren');
}]);

//login en logout routes
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::controllers([
    'wachtwoord' => 'Auth\PasswordController',
]);