<?php

use App\Http\Resources\ContentBlockCollection;
use App\Http\Resources\Review;
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

// GET Reviews and Review Content
Route::get('/reviews', function (Request $request) {
    if($request->type) {
        return new ReviewCollection(\App\EloquentModels\Review::where(['type' => $request->type])->paginate());
    }
    return new ReviewCollection(\App\EloquentModels\Review::paginate());
});
Route::get('/review/{id}', function (Request $request) {
    return new Review(\App\EloquentModels\Review::find($request->id));
});
Route::get('/review/{id}/contentBlocks', function (Request $request) {
    return new ContentBlockCollection(\App\EloquentModels\Review::find($request->id)->content_blocks);
});
