<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
// use Request;

class Controller extends BaseController
{
    public function signup(Request $req)  {
      
        $submit= $req['submit'];
        if ($submit=="submit") {
            $req->validate([
                'first_name'=>'required',
                'last_name'=>'required',
                'gender'=>'required',
                'email'=>'required|email|unique:users,email',
                'username'=>'required',
                'userpass'=>'required|alpha_num|min:8'
               ]);
            

               $user = new User;
               //escaping 
               
               $user->first_name= $req['first_name'];
               $user->last_name=$req['last_name'];
               $user->gender=$req['gender'];
               $user->email=$req['email'];
               $user->username=$req['username'];
               $user->password= Hash::make($req['userpass']);
               $user->save();
<<<<<<< HEAD
               return redirect('/login')->withSuccess('Your account has created');
=======
               $success='your account has been created';
               return redirect('/login')->with($success);
>>>>>>> 188252b71dc6903aedd5d7c071aaff32081b31d7

        }
        return view('signup',['page_title'=>'Signup']);
    }

    // checking email registered
    public function login(Request $req){
<<<<<<< HEAD
        $submit=$req['submit'];
        if($submit=="submit")
        {
            $input = $req->all();
        //    print_r($req->all());

           $req->validate([
            'email'=>'required',
            'password'=>'required'
           ]);
           $fieldType = filter_var($req->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
         
        //    if(\Auth::attempt($req->only(['email','password'])))
           if(\Auth::attempt(  array($fieldType => $input['email'], 'password' => $input['password'])))
            return redirect('/home');
        else
                return redirect('/login')->withError('Incorrect Username or Password');
        }
        return view('login',['page_title'=>'Login Page']);
=======
        $submit= $req['submit'];
        if ($submit=="submit") {
            $req->validate(
                [
                    'username_email'=>'required',
                    'password'=>'required|min:8'
                ]);
            if (\Auth::attempt($req->only('email','username','password'))) {
              return '<script>alert("You are logged in")</script>';
            } else {
               return redirect('/login')->withError('Incorrect Username or password');
            }
            
        }
        return view('login',['page_title'=>'login']);
>>>>>>> 188252b71dc6903aedd5d7c071aaff32081b31d7
    }

   
}
