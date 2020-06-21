<?php

namespace App\Http\Controllers\api\v1;

use App\EloquentModels\ContentBlock;
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
            'type' => 'required|in:beer,footy',
            'publish_date' => 'required|integer',
            'content_blocks' => 'array',
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

        $content_blocks = $request->content_blocks;
        $title = $request->title;
        $type = $request->type;
        $publish_date = $request->publish_date;

        $review = new Review();
        $review->user_id = $user->id;
        $review->title = $title;
        $review->type = $type;
        $review->publish_date = $publish_date;
        $review->status = 'published';
        $review->save();

        if ($content_blocks) {
            $newBlocks = [];
            foreach ($content_blocks as $block ) {
                $newBlocks[] = factory(ContentBlock::class)->make($block);
            }
            $review->content_blocks()->saveMany($newBlocks);
        }

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
}
