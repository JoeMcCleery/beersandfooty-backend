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
        $filterDefault = [
            'type' => ['beer', 'footy'],
            'limit' => 10,
            'order' => [
                'field' => 'publish_date',
                'direction' => 'desc'
            ]
        ];
        $filter = $request->filter ? json_decode($request->filter) : $filterDefault;
        return new ReviewCollection(Review::where(['status' => 'published'])->whereIn('type', $filter->type)->withCount('votes')->orderBy($filter->order->field, $filter->order->direction)->paginate($filter->limit));
    }

    public function show($id)
    {
        return new ReviewResource(Review::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'type' => 'in:beer,footy',
            'publish_date' => 'required|string',
        ]);

        if(!$validatedData) {
            return [
                'success' => false,
                'message'  => 'Could not validate request!',
            ];
        }

        $user = auth('api')->user();

        if (!$user) {
            return [
                'success' => false,
                'message'  => 'Must be logged in to make reviews!',
            ];
        }

        $title = $request->title;
        $type = $request->type;
        $publish_date = $request->publish_date;

        $review = new Review();
        $review->user_id = $user->id;
        $review->title = $title;
        $review->type = $type;
        $review->publish_date = $publish_date;
        $review->save();

        return [
            'success' => true,
            'data' => [
                'review' => $this->show($review->id)
            ]
        ];
    }

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
