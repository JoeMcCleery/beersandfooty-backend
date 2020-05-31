<?php

namespace App\Http\Controllers\api\v1;

use App\EloquentModels\Review;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewCollection;
use Illuminate\Http\Request;
use App\Http\Resources\Review as ReviewResource;

class ReviewController extends Controller
{
    public function review(Request $request, $id)
    {
        return new ReviewResource(Review::where(['status' => 'published'])->findOrFail($id));
    }

    public function reviews(Request $request)
    {
        return new ReviewCollection(Review::where(['status' => 'published'])->orderBy('publish_date', 'desc')->paginate());
    }

    public function beerReviews(Request $request)
    {
        return new ReviewCollection(Review::where(['type' => 'beer', 'status' => 'published'])->orderBy('publish_date', 'desc')->paginate());
    }

    public function footyReviews(Request $request)
    {
        return new ReviewCollection(Review::where(['type' => 'footy',  'status' => 'published'])->orderBy('publish_date', 'desc')->paginate());
    }
}
