<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticateController extends Controller
{
    public function login(Request $request)
    {
        $login_credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(auth()->attempt($login_credentials)){

            $user_login_token= auth()->user()->createToken($login_credentials['email'])->accessToken;

            return response()->json([
                'token' => $user_login_token,
                'user' => [
                    'id' => auth()->user()->id,
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email
                ]
            ], 200);
        }
        else{

            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }
    }
}
