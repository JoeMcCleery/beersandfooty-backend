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
    // User Auth
    Route::post('/login', 'api\v1\LoginController@login');
    Route::post('/register', 'api\v1\LoginController@register');

    // GET a single Review by id
    Route::get('/review/{id}', 'api\v1\ReviewController@review');
    // GET all Reviews
    Route::get('/reviews', 'api\v1\ReviewController@reviews');
    // GET all beer Reviews
    Route::get('/reviews/beer', 'api\v1\ReviewController@beerReviews');
    // GET all footy Reviews
    Route::get('/reviews/footy', 'api\v1\ReviewController@footyReviews');
});


