<?php

use App\EloquentModels\Review;
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

Route::get('/redirect', function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));

    $query = http_build_query([
        'client_id' => 'client-id',
        'redirect_uri' => 'http://example.com/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect(env('APP_URL', 'http://localhost').'/oauth/authorize?'.$query);
});

// GET all Reviews
Route::get('/reviews', function (Request $request) {
    return new ReviewCollection(Review::where(['status' => 'published'])->orderBy('publish_date', 'desc')->paginate());
});
// GET all beer Reviews
Route::get('/reviews/beer', function (Request $request) {
    return new ReviewCollection(Review::where(['type' => 'beer', 'status' => 'published'])->orderBy('publish_date', 'desc')->paginate());
});
// GET all footy Reviews
Route::get('/reviews/footy', function (Request $request) {
    return new ReviewCollection(Review::where(['type' => 'footy',  'status' => 'published'])->orderBy('publish_date', 'desc')->paginate());
});
// GET a single Review by id
Route::get('/review/{id}', function (Request $request, $id) {
    return new ReviewResource(Review::where(['status' => 'published'])->findOrFail($id));
});
