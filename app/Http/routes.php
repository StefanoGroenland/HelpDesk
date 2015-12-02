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
//Routes for user eyes only
Route::group(['middleware' => 'auth'], function () {

//    UserController Routes
    Route::get('/admindashboard', array('as' => 'admindashboard', 'uses' => 'UserController@showDashboard'));
    Route::get('/dashboard', array('as' => 'dashboard', 'uses' => 'UserController@showDashboard'));
    Route::get('/profiel', array('as' => 'profiel', 'uses' => 'UserController@showProfiel'));
    Route::get('/medewerkermuteren', array('as' => 'mwmuteren', 'uses' =>'UserController@showMwMuteren'));
    Route::post('/updateData', array('as' => 'updateData', 'uses' => 'UserController@getUpdateData'));
    Route::put('/updateMedewerker', array('as' => 'veranderMw', 'uses' => 'UserController@updateMedewerker'));
    Route::get('/verwijderGebruiker/{id}', 'UserController@verwijderGebruiker');
    Route::post('addMedewerker', 'UserController@addMedewerker');

//    ProjectController Routes
    Route::get('/projectmuteren', array('as' => 'projectmuteren', 'uses' => 'ProjectController@showProjectMuteren'));
    Route::put('/updateProject', array('as' => 'veranderPJ', 'uses' => 'ProjectController@updateProject'));
    Route::post('/updateProjectData', array('as' => 'updateData', 'uses' => 'ProjectController@getUpdateData'));
    Route::get('/verwijderProject/{id}', 'ProjectController@verwijderProject');
    Route::post('/addProject', 'ProjectController@addProject');

//    BugController Routes
    Route::get('/bugchat/{id}',array('as' => 'bugchat', 'uses' => 'BugController@showbugChat'));
    Route::get('/bugmuteren', array('as' => 'bugmuteren', 'uses' => 'BugController@showBugMuteren'));
    Route::get('/bugoverzicht', array('as' => 'bugoverzicht', 'uses' => 'BugController@showBugOverzicht'));
    Route::get('/verwijderBug/{id}', 'BugController@verwijderBug');


});

//unrestricted routes
Route::get('/', function () {
    return view('auth/welcome');
});

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::controllers([
    'wachtwoord' => 'Auth\PasswordController',
]);