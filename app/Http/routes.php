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

Route::get('/', function () {
    return view('home.index');
});

/* Entrance Page */

Route::post('entrance/submit-code', 'ProductsController@submitCode');

/* Landing Page */

Route::get('landing-page', function() {
    return view('landing-page.index');
});

Route::post('landing-page/add-experience', 'ProductsController@addExperience');


/* Thank your Page */

Route::get('thank-you', function() {
    return view('thank-you');
});

Route::post('thank-you/store', 'ProductsController@setReplyTrue');



/***** PRODUCERS PANEL *****/
Route::get('producers', 'ProducersController@index');

Route::get('producers/experience/{experience}', 'ProducersController@showExperience');

Route::get('producers/experience/{experience}/reply', 'ProducersController@replyExperience');

Route::post('producers/experience/{experience}/sendReply', 'ProducersController@sendReply');


/***** Display Image *****/

Route::get('images/{filename}', 'ProductsController@showImage');


/* Tests */

Route::get('test', 'ImagesController@test');
Route::auth();

Route::get('/home', 'HomeController@index');
