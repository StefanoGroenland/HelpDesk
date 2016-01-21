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

//    global ones
    Route::get('/profiel', array('as' => 'profiel', 'uses' => 'UserController@showProfiel'));
    Route::put('/updateProfiel', array('as' => 'upd_profile', 'uses' => 'UserController@updateProfiel'));
    Route::put('/profiel/upload', 'UserController@upload');


//    klant routes
    Route::get('/dashboard', array('as' => 'dashboard', 'uses' => 'UserController@showDashboard'));

    Route::group(['middleware' => 'isAdmin'], function(){
        Route::get('/klantwijzigen/{id}', array('as' => 'klantwijzigen', 'uses' =>'UserController@showKlantMuteren'));
        Route::get('/newklant', array('as' => 'newklant', 'uses' =>'UserController@showNewKlant'));
        Route::post('/updateKlantData', array('as' => 'klantdata', 'uses' => 'UserController@getKlantData'));
        Route::put('/updateKlant', array('as' => 'veranderk', 'uses' => 'UserController@updateKlant'));
        Route::post('addUser', 'UserController@addUser');
        Route::get('/klanten', array('as' => 'klanten', 'uses' => 'UserController@showKlantenOverzicht' ));

//            medewerker routes
        Route::get('/medewerkerwijzigen/{id}', array('as' => 'medewerkerwijzigen', 'uses' =>'UserController@showMwMuteren'));
        Route::get('/newmedewerker', array('as' => 'newmedewerker', 'uses' =>'UserController@showNewMedewerker'));
        Route::put('/updateMedewerker', array('as' => 'veranderMw', 'uses' => 'UserController@updateMedewerker'));
        Route::post('/updateData', array('as' => 'updateData', 'uses' => 'UserController@getUpdateData'));
        Route::post('addMedewerker', 'UserController@addMedewerker');
        Route::get('/medewerkers',array('as' => 'medewerkers', 'uses' =>  'UserController@showMedewerkersOverzicht'));
        Route::delete('/verwijderGebruiker/{id}', 'UserController@verwijderGebruiker');
        Route::put('/resetUserPassword', 'UserController@resetUserPassword');


        //    ProjectController Routes
        Route::get('/newproject', array('as' => 'newproject', 'uses' => 'ProjectController@showNewProject'));
        Route::get('/projectwijzigen/{id}', array('as' => 'projectwijzigen', 'uses' => 'ProjectController@showProjectMuteren'));
        Route::put('/updateProject/{id}', array('as' => 'veranderPJ', 'uses' => 'ProjectController@updateProject'));
        Route::post('/updateProjectData', array('as' => 'updateData', 'uses' => 'ProjectController@getUpdateData'));
        Route::delete('/verwijderProject/{id}', 'ProjectController@verwijderProject');
        Route::post('/addProject', 'ProjectController@addProject');
        Route::get('/projecten',array('as' => 'projecten', 'uses' => 'ProjectController@showProjectenOverzicht'));

        //    BugController Routes
        Route::delete('/verwijderBug/{id}', 'BugController@verwijderBug');
        Route::put('/updateBug/{id}',array('as' => 'updateBug', 'uses' => 'BugController@updateBug'));
    });

    Route::get('/feedbackmelden/{id}', array('as' => 'feedbackmelden', 'uses' => 'BugController@showBugMuteren'));

    Route::get('/bugchat/{id}',array('as' => 'bugchat', 'uses' => 'BugController@showbugChat'));
    Route::post('/addBug/{id}', 'BugController@addBug');
    Route::post('/upload', 'BugController@upload');
    Route::get('/bugoverzicht/{id}', array('as' => 'bugoverzicht', 'uses' => 'BugController@showBugOverzicht'));
    Route::get('/bugs/{id}', array('as' => 'bugs', 'uses' => 'BugController@showBugOverzichtPerProject'));

//    ChatController Routes
    Route::post('/sendMessage', 'ChatController@sendMessage');
    Route::get('/refreshChat/{id}',array('as' => 'bugchat', 'uses' => 'BugController@refreshChat'));
    Route::get('/feedCount/{id}',array('as' => 'feed_count', 'uses' => 'BugController@feedCount'));

});

//unrestricted routes
Route::get('/', 'UserController@showWelcome');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::controllers([
    'wachtwoord' => 'Auth\PasswordController',
]);

// Password reset link request routes...
Route::get('auth/email', 'Auth\PasswordController@getEmail');
Route::post('auth/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('auth/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('auth/reset', 'Auth\PasswordController@postReset');