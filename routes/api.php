<?php

use App\EloquentModels\Review;
use App\Http\Resources\ContentBlockCollection;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// GET all Reviews
Route::get('/reviews', function (Request $request) {
    if($request->type) {
        return new ReviewCollection(Review::where(['type' => $request->type])->paginate());
    }
    return new ReviewCollection(Review::paginate());
});
// GET Review by id
Route::get('/review/{id}', function (Request $request) {
    return new ReviewResource(Review::find($request->id));
});
