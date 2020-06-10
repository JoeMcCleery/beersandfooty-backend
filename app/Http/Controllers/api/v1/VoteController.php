<?php

namespace App\Http\Controllers\api\v1;

use App\EloquentModels\User;
use App\EloquentModels\Vote;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\VoteCollection;
use Illuminate\Http\Request;
use App\Http\Resources\Vote as VoteResource;
use Illuminate\Support\Facades\Auth;

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
            'user_id' => 'required|integer',
            'review_id' => 'required|integer',
        ]);

        if(!$validatedData) {
            return [
                'success' => false,
                'message'  => 'Could not validate request!',
            ];
        }

        $upvote = $request->upvote;
        $user_id = $request->user_id;
        $review_id = $request->review_id;

        $vote = Vote::withTrashed()->where(['user_id' => $user_id, 'review_id' => $review_id])->get();

        if ($vote && $vote->trashed()) {
            $vote->restore();
            $vote->upvote = $upvote;
            $vote->save();
        } else {
            $vote = new Vote();
            $vote->upvote = $upvote;
            $vote->user_id = $user_id;
            $vote->review_id = $review_id;
        }

        return [
            'success' => true,
            'data' => [
                'vote' => $this->show($vote->id)
            ]
        ];
    }

    public function update(Request $request, $id)
    {}

    public function delete(Request $request, $id)
    {
        $vote = Vote::findOrFail($id);
        if ($vote && $vote->user_id === auth('api')->user()->id) {
            $vote->delete();

            return [
                'success' => true,
                'message' => 'Vote with id: '.$id.' has been deleted.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Could not find vote with id: '.$id.', or do not have permission to delete.'
        ];
    }

}
