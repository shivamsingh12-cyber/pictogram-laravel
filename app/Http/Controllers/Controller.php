<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
                $_SESSION['user']=Auth::user();
                // return view('mainpage.home',['page_title' => 'Home']);
                // if ($_SESSION['user']['ac_status']== 0 && Auth::check()) {
                //     return redirect('/verify');
                //  }
                //  elseif ($_SESSION['user']['ac_status']== 1 && Auth::check()) {
                //     return redirect('/home');
                //  }
                //  elseif ($_SESSION['user']['ac_status']== 2 && Auth::check()) {
                //     return redirect('/block');
                //  }
               
            }
            else
                return redirect('/login')->withError('Incorrect Username or Password');
        }
        return view('login', ['page_title' => 'Login Page']);
    }

    public function dashboard()
    {
       
        return view('mainpage.home', ['page_title' => 'Home']);
    }
   
    public function block()
    {
        return view('blocked', ['page_title' => 'Blocked']);
    }
    public function verify()
    {
        return view('verified', ['page_title' => 'Verify']);
    }

    public function logout()
    {
        \Session::flush();
        Auth::logout();
        return redirect('/login');
    }


}
