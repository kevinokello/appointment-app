<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
       $pageTitle = 'Login Page';

       return view('frontend.auth.login',compact('pageTitle'));
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user){
            $notify[] = ['error','No user found associated with this email'];
             return redirect()->route('user.login')->withNotify($notify);
        }

   
        if (Auth::attempt($data)) {

            $notify[] = ['success','Successfully logged in'];

            return redirect()->intended('user/dashboard')
                        ->withNotify($notify);
        }
        
        $notify[] = ['error','Invalid Credentials'];
        return redirect()->route('user.login')->withNotify($notify);
    }

    

}
