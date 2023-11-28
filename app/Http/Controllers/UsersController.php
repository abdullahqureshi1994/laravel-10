<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function login(Request $request) {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            if(Auth::user()->hasVerifiedEmail()) {
                $user = Auth::user();
                $data['jwtAccessToken'] =  $user->createToken('jwtAccessToken')->accessToken;
                return response($data, 200);

            } else{
                return response('User registered but email is not verified.', 403);
            }
        } else {
            return response('Invalid email or password.', 403);
        }
    }
}
