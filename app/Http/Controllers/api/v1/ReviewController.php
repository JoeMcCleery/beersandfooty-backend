<?php

namespace App\Http\Controllers\api\v1;

use App\EloquentModels\ContentBlock;
use App\EloquentModels\Review;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewCollection;
use Illuminate\Http\Request;
use App\Http\Resources\Review as ReviewResource;
use Intervention\Image\ImageManagerStatic as Image;

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

        $review = Review::find($id);

        if (!$review || $review->user_id !== $user->id) {
            return [
                'success' => false,
                'message' => 'Could not find review with id:'.$id.', or do not have permission to delete.'
            ];
        }

        $review->content_blocks()->delete();

        $review->title = $title;
        $review->type = $type;
        $review->publish_date = $publish_date;
        $review->status = 'published';

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

    private function createContentBlocksAndSaveToReview($review, $contenBlocks) {
        if (count($contenBlocks)) {
            foreach ($contenBlocks as $block ) {
                if($block['type'] === 'image') {
                    $imageData = str_replace(array('data:image/png;base64,', 'data:image/jpg;base64,', 'data:image/jpeg;base64,', 'data:image/gif;base64,', ' '), array('', '', '', '', '+'), $block['content']);
                    if(preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $imageData)) {
                        $extension = '.'.explode('/', mime_content_type($block['content']))[1];
                        $fileName = 'uploads/'.hash('md5', $block['content']);
                        if(file_exists(storage_path('app/public/'.$fileName.'-resized'.$extension))) {
                            $block['content'] = url('storage/'.$fileName.'-resized'.$extension);
                        } else {
                            $imageData = str_replace(array('data:image/png;base64,', 'data:image/jpg;base64,', 'data:image/jpeg;base64,', 'data:image/gif;base64,', ' '), array('', '', '', '', '+'), $block['content']);
                            $image_resize = Image::make(base64_decode($imageData));
                            $image_resize = $this->resizeImage($image_resize, 512);
                            $image_resize->save(storage_path('app/public/'.$fileName.'-resized'.$extension));
                            $block['content'] = url('storage/'.$fileName.'-resized'.$extension);
                        }
                    }
                }
                $block['id'] = 0;
                $review->content_blocks()->save(factory(ContentBlock::class)->make($block));
            }
        }
    }

    private function resizeImage($image, $requiredSize) {
        $width = $image->width();
        $height = $image->height();

        // Check if image resize is required or not
        if ($requiredSize >= $width && $requiredSize >= $height) return $image;

        $newWidth = 0;
        $newHeight = 0;

        $aspectRatio = $width/$height;
        if ($aspectRatio >= 1.0) {
            $newWidth = $requiredSize;
            $newHeight = $requiredSize / $aspectRatio;
        } else {
            $newWidth = $requiredSize * $aspectRatio;
            $newHeight = $requiredSize;
        }


        $image->resize($newWidth, $newHeight);
        return $image;
    }
}
