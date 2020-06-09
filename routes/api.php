<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->middleware('client')->group( function () {
    // User
    Route::get('/user', 'api\v1\UserController@currentUser');
    Route::get('/users', 'api\v1\UserController@index');
    Route::get('/users/{id}', 'api\v1\UserController@show');
    Route::post('/users', 'api\v1\UserController@store');
    Route::put('/users/{id}', 'api\v1\UserController@update');
    Route::delete('/users/{id}', 'api\v1\UserController@delete');

    // Review
    Route::get('/reviews', 'api\v1\ReviewController@index');
    Route::get('/reviews/{id}', 'api\v1\ReviewController@show');
    Route::post('/reviews', 'api\v1\ReviewController@store');
    Route::put('/reviews', 'api\v1\ReviewController@update');
    Route::delete('/reviews/{id}', 'api\v1\ReviewController@delete');

    // Votes
    Route::get('/votes', 'api\v1\VoteController@index');
    Route::get('/votes/{id}', 'api\v1\VoteController@show');
    Route::post('/votes', 'api\v1\VoteController@store');
    Route::put('/votes', 'api\v1\VoteController@update');
    Route::delete('/votes/{id}', 'api\v1\VoteController@delete');

    // returns all published beer reviews
    Route::get('/beer-reviews', 'api\v1\ReviewController@beerReviews');
    // returns all published footy reviews
    Route::get('/footy-reviews', 'api\v1\ReviewController@footyReviews');
});


