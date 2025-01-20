<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**

     * Create a new controller instance.

     *

     * @return void

     */

     public function redirectToGoogle()

     {
        return Socialite::driver('google')->redirect();
     }
 
           
 
     /**
      * Create a new controller instance.
      *
      * @return void
      */
 
     public function handleGoogleCallback()
 
     {
        try {
            $user = Socialite::driver('google')->user();
            
            return view('auth/register',[
                'title' => 'Register',
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => 4,
            ]);
        }catch (Exception $e) {
            dd($e->getMessage());
            // return redirect('auth/register')->with('error', 'Google login failed. Please try again.');
        }        
    }
}