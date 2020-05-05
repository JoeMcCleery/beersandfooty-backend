<?php

use App\Http\Resources\Review;
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

// Routes to READ reviews
Route::get('/reviews', function (Request $request) {
    return new Review(\App\EloquentModels\Review::paginate());
});
Route::get('/reviews/{id}', function (Request $request) {
    return new Review(\App\EloquentModels\Review::find($request->id));
});
Route::get('/reviews/{id}/contentBlocks', function (Request $request) {
    return new Review(\App\EloquentModels\Review::find($request->id)->content_blocks);
});
