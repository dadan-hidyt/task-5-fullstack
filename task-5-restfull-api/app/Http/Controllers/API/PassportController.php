<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class PassportController extends Controller
{
    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (!auth()->attempt($login)) {
            return response()->json('Credential Invalid');
        }
        //create user access token
        $accsess_token = Auth::user()->createToken('accessToken')->accessToken;
        return response()->json([
            'user'=>Auth::user(),
            'access_token' => $accsess_token,
        ],200);
    }
}
