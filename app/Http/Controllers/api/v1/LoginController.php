<?php

namespace App\Http\Controllers\api\v1;

use App\EloquentModels\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;

class LoginController extends Controller
{

    public function register(Request $request)
    {
        $register = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!$register) {
            return response([
                'success' => false,
                'message' => 'Could not validate Credentials'
            ]);
        }

        $username = $request->username;
        $password = $request->password;

        if (!User::where(['username' => $username])->get()->isEmpty()) {
            return response([
                'success' => false,
                'message' => 'Username is already in use'
            ]);
        }

        $user = User::create([
            'username' => $username,
            'password' => $password
        ]);
        auth()->login($user);
        $user = Auth::user();

        return response([
            'success' => true,
            'data' => [
                'user' => $user,
            ]
        ]);
    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!$login) {
            return response([
                'success' => false,
                'message' => 'Could not validate Credentials'
            ]);
        }

        if (!Auth::attempt($login)) {
            return response([
                'success' => false,
                'message' => 'Invalid login credentials'
            ]);
        }

        $user = Auth::user();

        return response([
            'success' => true,
            'data' => [
                'user' => $user,
            ]
        ]);
    }
}
