<?php

namespace App\Http\Controllers\api\v1;

use App\EloquentModels\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function currentUser()
    {
        $user = auth('api')->user();

        if($user) {
            return [
                'success' => true,
                'data' => [
                    'user' => new UserResource($user)
                ]
            ];
        }

        return [
            'success' => false,
            'message' => 'No currently logged in user found!'
        ];
    }

    public function index()
    {
        return new UserCollection(User::paginate());
    }

    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if(!$validatedData) {
            return [
                'success' => false,
                'message'  => 'Could not validate request!',
            ];
        }

        $username = $request->username;
        $password = $request->password;

        if(User::withTrashed()->where('username', $username)->first()) {
            return [
                'success' => false,
                'message'  => 'User with that username already exists!',
            ];
        }

        if(!preg_match('/^[a-zA-Z0-9]([._](?![._])|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$/', $username)) {
            return [
                'success' => false,
                'message'  => 'Username can only be 8 - 20 alpha numeric characters!',
            ];
        }

        $user = new User;
        $user->username = $username;
        $user->password = $password;
        $user->save();

        return [
            'success' => true,
            'data' => [
                'user' => $this->show($user->id)
            ]
        ];
    }

    public function update(Request $request, $id)
    {}

    public function delete(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user && $user !== auth('api')->user()) {
            return [
                'success' => false,
                'message' => 'Could not find User with id:'.$id.', or do not have permission to delete.'
            ];

        }

        $user->delete();


        return [
            'success' => true,
            'message' => 'User with id:'.$id.' has been deleted.'
        ];
    }

}
