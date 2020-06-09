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
    {}

    public function update(Request $request, $id)
    {}

    public function delete(Request $request, $id)
    {}

}
