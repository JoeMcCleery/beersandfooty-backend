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
    public function unpublishedReviews(Request $request) {
        return new ReviewCollection(Review::where(['status' => 'hidden'])->orderBy('publish_date', 'desc')->get());
    }

    public function publishedReviews(Request $request) {
        return new ReviewCollection(Review::where(['status' => 'published'])->orderBy('publish_date', 'desc')->get());
    }

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
            'status' => 'string'
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
        $status = $request->status ? $request->status : 'hidden';

        $review = new Review();
        $review->user_id = $user->id;
        $review->title = $title;
        $review->type = $type;
        $review->publish_date = $publish_date;
        $review->status = $status;
        $review->save();

        $this->createContentBlocksAndSaveToReview($review, $content_blocks);

        return [
            'success' => true,
            'data' => [
                'review' => $this->show($review->id)
            ]
        ];
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string',
            'type' => 'required|in:beer,footy',
            'publish_date' => 'required|integer',
            'content_blocks' => 'array',
            'status' => 'string',
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
        $id = $request->id;
        $status = $request->status ? $request->status : 'hidden';

        $review = Review::find($id);

        if (!$review || ($review->user_id !== $user->id && !$user->isAdmin())) {
            return [
                'success' => false,
                'message' => 'Could not find review with id:'.$id.', or do not have permission to update.'
            ];
        }

        $review->content_blocks()->delete();

        $review->title = $title;
        $review->type = $type;
        $review->publish_date = $publish_date;
        $review->status = $status;

        $this->createContentBlocksAndSaveToReview($review, $content_blocks);

        $review->save();

        return [
            'success' => true,
            'data' => [
                'review' => $this->show($review->id)
            ]
        ];
    }

    public function delete(Request $request, $id)
    {
        $review = Review::find($id);
        $user = auth('api')->user();

        if (!$user) {
            return [
                'success' => false,
                'message'  => 'Must be logged in to delete reviews!',
            ];
        }

        if (!$review || ($review->user_id !== $user->id && !$user->isAdmin())) {
            return [
                'success' => false,
                'message' => 'Could not find review with id: '.$id.', or do not have permission to delete.'
            ];
        }
        $review->content_blocks()->delete();
        $review->votes()->delete();
        $review->delete();

        return [
            'success' => true,
            'message' => 'Review with id:'.$id.' has been deleted.'
        ];
    }

    private function createContentBlocksAndSaveToReview($review, $contenBlocks) {
        if (count($contenBlocks)) {
            foreach ($contenBlocks as $block ) {
                $block['id'] = 0; // Set Zero so bellow creates a new block
                $review->content_blocks()->save(factory(ContentBlock::class)->make($block));
            }
        }
    }
}
