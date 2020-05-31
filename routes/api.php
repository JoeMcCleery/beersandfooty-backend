<?php

use App\EloquentModels\Review;
use App\Http\Controllers\api\v1\LoginController as V1LoginController;
use App\Http\Resources\Review as ReviewResource;
use App\Http\Resources\ReviewCollection;
use Illuminate\Http\Request;
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

Route::prefix('v1')->group( function () {
    // Users
    // user account Login
    Route::post('/login', 'api\v1\LoginController@login');
    // user account registration
    Route::post('/register', 'api\v1\LoginController@register');

    // Reviews
    // returns a single published review by id
    Route::get('/review/{id}', 'api\v1\ReviewController@review');
    // returns all published reviews
    Route::get('/reviews', 'api\v1\ReviewController@reviews');
    // returns all published beer reviews
    Route::get('/reviews/beer', 'api\v1\ReviewController@beerReviews');
    // returns all published footy reviews
    Route::get('/reviews/footy', 'api\v1\ReviewController@footyReviews');
});


