<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;

class ApiJWTAuthenticate extends Controller
{
    public function login()
    {
        $credential = request()->only('email', 'password');

        try{
            $token = JWTAuth::attempt($credential);

            if(!$token){
                return response()->json(['error' => 'invalid_credential']); //status 401
            }
        }
        catch(JWTException $e)
        {
            return response()->json(['error' => 'something_went_wrong'], 500);
        }

        return response()->json([
            'message' => 'sukses login',
            'token' => $token,
            'succes' => true
        ], 200);
    }
    public function register()
    {
        $username   = request()->username;
        $name       = request()->name;
        $email      = request()->email;
        $password   = request()->password;

        $user = User::create([
            'username'  => $username,
            'name'      => $name,
            'email'     => $email,
            'password'  => bcrypt($password)
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'token' => $token
        ], 200);
    }
}
