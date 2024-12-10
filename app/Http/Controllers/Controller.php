<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
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
                'email'=>'required|min:10',
                'username'=>'required',
                'password'=>'required'
               ]);

               $user = new User;
               $user->first_name=$req['first_name'];
               $user->last_name=$req['last_name'];
               $user->gender=$req['gender'];
               $user->email=$req['email'];
               $user->username=$req['username'];
               $user->password=$req['password'];
               $user->save();
               return redirect('/login');

        }
        return view('signup',['page_title'=>'Signup']);
    }

   
}
