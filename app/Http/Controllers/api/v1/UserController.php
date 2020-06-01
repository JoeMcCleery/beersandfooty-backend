<?php

namespace App\Http\Controllers\api\v1;

use App\EloquentModels\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function index()
    {
        return new UserCollection(User::all());
    }

    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    public function store(Request $request)
    {}

    public function update(Request $request, $id)
    {}

    public function delete(Request $request, $id)
    {}
}
