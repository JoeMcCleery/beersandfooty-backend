<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Review extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $upvotes = $this->votes->where('upvote', true)->count();
        $downvotes = $this->votes->where('upvote', false)->count();
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'author' => $this->user->username,
            'score' => $this->score,
            'type' => $this->type,
            'title' => $this->title,
            'publish_date' => $this->publish_date,
            'content_blocks' => ContentBlockCollection::make($this->content_blocks),
            'votes' => [
                'upvotes' => $upvotes,
                'downvotes' => $downvotes
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
