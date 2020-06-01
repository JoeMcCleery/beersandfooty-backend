<?php

use App\EloquentModels\Review;
use App\Http\Controllers\api\v1\UserController as V1LoginController;
use App\Http\Resources\Review as ReviewResource;
use App\Http\Resources\ReviewCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

    // returns all published beer reviews
    Route::get('/beer-reviews', 'api\v1\ReviewController@beerReviews');
    // returns all published footy reviews
    Route::get('/footy-reviews', 'api\v1\ReviewController@footyReviews');
});


