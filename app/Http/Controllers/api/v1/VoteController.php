<?php

namespace App\Http\Controllers\api\v1;

use App\EloquentModels\Vote;
use App\Http\Controllers\Controller;
use App\Http\Resources\VoteCollection;
use Illuminate\Http\Request;
use App\Http\Resources\Vote as VoteResource;

class VoteController extends Controller
{
    public function index()
    {
        return new VoteCollection(Vote::paginate());
    }

    public function show($id)
    {
        return new VoteResource(Vote::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'upvote' => 'required|boolean',
            'review_id' => 'required|integer',
        ]);

        if(!$validatedData) {
            return [
                'success' => false,
                'message'  => 'Could not validate request!',
            ];
        }

        $upvote = $request->upvote;
        $review_id = $request->review_id;
        $user = auth('api')->user();

        if (!$user) {
            return [
                'success' => false,
                'message'  => 'Must be logged in to make votes!',
            ];
        }

        $vote = Vote::where(['user_id' => $user->id, 'review_id' => $review_id])->first();
        if ($vote) {
            $vote->upvote = $upvote;
        } else {
            $vote = new Vote;
            $vote->upvote = $upvote;
            $vote->user_id = $user->id;
            $vote->review_id = $review_id;
        }
        $vote->save();

        return [
            'success' => true,
            'data' => [
                'votes' => new VoteCollection($user->votes)
            ]
        ];
    }

    public function update(Request $request, $id)
    {}

    public function delete(Request $request, $id)
    {
        $user = auth('api')->user();
        $vote = Vote::find($id);
        if(!$vote || !$user || !$user->id === $vote->user_id) {
            return [
                'success' => false,
                'message' => 'Could not find Vote with id: '.$id.', or do not have permission to delete.'
            ];
        }

        $vote->delete();

        return [
            'success' => true,
            'data' => [
                'votes' => new VoteCollection($user->votes)
            ]
        ];

    }

}
