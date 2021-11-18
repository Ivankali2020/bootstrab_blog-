<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){

        try {
              $user = Socialite::driver('google')->stateless()->user();
              $finduser = User::where('provider_id', $user->id)->first();


            if($finduser){

                Auth::login($finduser);
                return redirect('/profile/home');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id'=> $user->id,
                    'provider' => 'google',
                    'password' => Hash::make('ivan2020'),
                ]);

                Auth::login($newUser);

                return redirect('/profile/home');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
