<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use Hash;
use App\Transformers\UserTransformers;
use Laravel\Socialite\Facades\Socialite;

class AuthGoogle extends Controller
{

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('google')->stateless()->user();

        $findUser = User::where('email', $userSocial->email)->first();

        if($findUser){
            Auth::login($findUser);
            if(auth()->user()->getRuleName($findUser->roles_id)=='Admin')
            {
                return redirect('/admin');
            }
            else if(auth()->user()->getRuleName($findUser->roles_id)=='Penjual')
            {
                return redirect('/penjual');
            }
            else if(auth()->user()->getRuleName($findUser->roles_id)=='Pembeli')
            {
                return redirect('/pembeli');
            }
        }else {
            $user = new User;
            $user->username = trim($userSocial->name);
            $user->nama = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt(123456);

            $user->save();

            Auth::login($user);
            return redirect('/user');

            // if(auth()->user()->getRuleName($user->roles_id)=='Admin')
            // {
            //     return redirect('/admin');
            // }
            // else if(auth()->user()->getRuleName($user->roles_id)=='Penjual')
            // {
            //     return redirect('/penjual');
            // }
            // else if(auth()->user()->getRuleName($user->roles_id)=='Pembeli')
            // {
            //     return redirect('/pembeli');
            // }
        }

    }
}
