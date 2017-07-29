<?php

namespace App\Http\Controllers;

use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use Hash;
use App\Transformers\UserTransformers;
use Laravel\Socialite\Facades\Socialite;

class AuthenticateController extends Controller
{
    //protected $redirectTo = '/admin';

    public function postRegister(Request $request, User $user){
        //confirmed

        $this->validate($request, [
            'username'  => 'required|username|unique:users',
            'nama'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6|confirmed',
        ]);

//        return dd($request->all());
        // $user = $user->create([
        //     'username'  => $request->username_,
        //     'nama'      => $request->nama,
        //     'email'     => $request->email,
        //     'password'  => bcrypt($request->password_)
        // ]);

        // //untuk login ke auth
        // $this->guards()->login($user);

        // return redirect('/user');
    }

    public function postLogin(Request $request, User $user){
        $this->validate($request, [
            'email'     => 'required',
            'password'  => 'required',
        ]);
        
        if(Auth::attempt([
            'email'=>$request->email,
            'password' =>$request->password,
        ], true) | Auth::attempt([
            'username'=>$request->email,
            'password' =>$request->password,
        ], true)){
            return redirect('/user');
        }
        else if(!Auth::attempt([
            'email'=>$request->email,
            'password' =>$request->password,
        ])){
            return response()->json([
                'error' => 'Your credential is Wrong!!'
            ], 401);
        }
    }

        //FACEBOOK LOGIN
        public function redirectToProvider()
        {
            return Socialite::driver('facebook')->redirect();
        }

        /**
         * Obtain the user information from GitHub.
         *
         * @return Response
         */
        public function handleProviderCallback()
        {
            $userSocial = Socialite::driver('facebook')->user();

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
