<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\sendmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Request;

class Controller extends BaseController
{
    public function signup(Request $req)
    {

        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'email' => 'required|email|unique:users,email',
                'username' => 'required',
                'userpass' => 'required|alpha_num|min:8'
            ]);


            $user = new User;
            //escaping 

            $user->first_name = $req['first_name'];
            $user->last_name = $req['last_name'];
            $user->gender = $req['gender'];
            $user->email = $req['email'];
            $user->username = $req['username'];
            $user->password = Hash::make($req['userpass']);
            $user->save();
            return redirect('/login')->withSuccess('Your account has created');

        }
        return view('signup', ['page_title' => 'Signup']);
    }

    // checking email registered
    public function login(Request $req)
    {
        $submit = $req['submit'];
        if ($submit == "submit") {
          

            $req->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
            $fieldType = filter_var($req->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
       
            if (\Auth::attempt(array($fieldType => $req['email'], 'password' => $req['password']))) {
                // $_SESSION['user']=Auth::user();
                
                    $to=Auth::user()->email;
                    $message="Pictogram Verification OTP is:: ";
                    $subject="Pictogram Verification";
                Mail::to($to)->send(new  sendmail($message,$subject));
                    return redirect('/verify');
              
            }
            else
                return redirect('/login')->withError('Incorrect Username or Password');
        }
        return view('login', ['page_title' => 'Login Page']);
    }

    public function dashboard()
    {
    //    if (Auth::check() && Auth::user()->ac_status==1) {
    //     // return view('mainpage.home', ['page_title' => 'Home']);
        return view('mainpage.home', ['page_title' => 'Home']);
    //    }
    //    elseif (Auth::check() && Auth::user()->ac_status==2) {
    //     // return view('blocked', ['page_title' => 'Blocked']);
    //     return redirect('/block');
    //    }
    //     else{
    //         // return view('verified', ['page_title' => 'Verify here']);
    //         return redirect('/verify');
    //     }
    }
    
   
    public function block()
    {
        return view('blocked', ['page_title' => 'Blocked']);
    }
    public function verify()
    {
        return view('verified', ['page_title' => 'Verify here']);
    }

    public function logout()
    {
        \Session::flush();
        Auth::logout();
        return redirect('/login');
    }

   

}
