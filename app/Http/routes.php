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
//loginscherm voor klanten
Route::get('/', function () {
    return view('auth/welcome');
});
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
//loginscherm voor admins
Route::get('/admin', function () {
    return view('auth/admin');
});
//klantdashboard scherm
Route::get('/dashboard', function () {
    return view('dashboard');
});
//admin dashboard scherm
Route::get('/admindashboard', function () {
    return view('admindashboard');
});
//bugchatscherm
Route::get('/bugchat', function () {
    return view('bugchat');
});
//bugmuteren scherm
Route::get('/bugmuteren', function () {
    return view('bugmuteren');
});
//bugoverzicht scherm
Route::get('/bugoverzicht', function () {
    return view('bugoverzicht');
});
//medewerker muteren scherm
Route::get('/medewerkermuteren', function () {
    return view('medewerkermuteren');
});
//profiel scherm
Route::get('/profiel', function () {
    return view('profiel');
});
//projectmuteren scherm
Route::get('/projectmuteren', function () {
    return view('projectmuteren');
});