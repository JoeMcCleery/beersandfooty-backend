<?php

namespace App\Http\Controllers\api\v1;

use App\EloquentModels\ContentBlock;
use App\EloquentModels\Review;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContentBlockCollection;
use Illuminate\Http\Request;
use App\Http\Resources\ContentBlock as ContentBlockResource;

class ContentBlockController extends Controller
{
    public function index(Request $request)
    {
        return new ContentBlockCollection(ContentBlock::paginate());
    }

    public function show($id)
    {
        return new ContentBlockResource(ContentBlock::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sort' => 'require|integer',
            'block_content' => 'required|string',
            'type' => 'required|in:long_text,short_text,score,image',
            'review_id' => 'require|integer'
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
                'message'  => 'Must be logged in to make Content Blocks!',
            ];
        }

        $review_id = $request->review_id;
        $review = Review::find($review_id);

        if($review || ($review->user_id !== $user->id && !$user->isAdmin())) {
            return [
                'success' => false,
                'message'  => 'Could not find Review, or do not have permission to add Content Blocks to Review with id:'.$review_id.'!',
            ];
        }

        $content = $request->block_content;
        $type = $request->type;
        $sort = $request->sort;

        $block = new ContentBlock();
        $block->content = $content;
        $block->type = $type;
        $block->sort = $sort;
        $block->review_id = $review_id;
        $block->save();

        return [
            'success' => true,
            'data' => [
                'content_block' => $this->show($block->id)
            ]
        ];
    }

    public function update(Request $request, $id)
    {}

    public function delete(Request $request, $id)
    {
        $block = ContentBlock::find($id);
        $user = auth('api')->user();

        if (!$user) {
            return [
                'success' => false,
                'message'  => 'Must be logged in to make Content Blocks!',
            ];
        }

        if (!$block || ($block->user_id !== $user->id && !$user->isAdmin())) {
            return [
                'success' => false,
                'message' => 'Could not find review with id:'.$id.', or do not have permission to delete.'
            ];
        }

        $block->delete();

        return [
            'success' => true,
            'message' => 'Content Block with id:'.$id.' has been deleted.'
        ];
    }

}
