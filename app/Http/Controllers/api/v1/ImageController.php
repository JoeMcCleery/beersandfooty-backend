<?php

namespace App\Http\Controllers\api\v1;

use App\EloquentModels\Vote;
use App\Http\Controllers\Controller;
use App\EloquentModels\Review;
use App\Http\Resources\VoteCollection;
use Illuminate\Http\Request;
use App\Http\Resources\Vote as VoteResource;

class ImageController extends Controller
{
    public function index()
    {}

    public function show($id)
    {}

    public function store(Request $request)
    {}

    public function update(Request $request, $id)
    {}

    public function delete(Request $request, $id)
    {}
}
