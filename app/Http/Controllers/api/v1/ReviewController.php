<?php

namespace App\Http\Controllers\api\v1;

use App\EloquentModels\Review;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewCollection;
use Illuminate\Http\Request;
use App\Http\Resources\Review as ReviewResource;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        return new ReviewCollection(Review::paginate());
    }

    public function show(Request $request, $id)
    {
        return new ReviewResource(Review::findOrFail($id));
    }

    public function store(Request $request)
    {}

    public function update(Request $request, $id)
    {}

    public function delete(Request $request, $id)
    {
        $review = Review::find($id);
        if (!$review && $review->user_id !== auth('api')->user()->id) {
            return [
                'success' => false,
                'message' => 'Could not find review with id:'.$id.', or do not have permission to delete.'
            ];
        }

        $review->delete();

        return [
            'success' => true,
            'message' => 'Review with id:'.$id.' has been deleted.'
        ];
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
