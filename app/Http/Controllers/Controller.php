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
use Session;
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
                if (Auth::check() && Auth::user()->ac_status==0) {
                    $to=Auth::user()->email;
                    $userid=Auth::user()->id;
                    Session::put('userid',$userid);
                    $otp=rand(100000,999999);
                    Session::put('user_otp',$otp);
                    $message="Pictogram Verification OTP is:: ";
                    $subject="Pictogram Verification";
                Mail::to($to)->send(new  sendmail($otp,$message,$subject));
                return redirect('/verify')->withSent('An OTP has been sent to Your Gmail Account');
                }
                
                else{
                    return redirect('/home');
                }
             
                    
              
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
    public function verify(Request $request)
    {
        $submit=$request['submit'];
        if (isset($submit)) {
            $request->validate([
                'verify'=>'required'
            ]);
            $userid=Session::get('userid');
            $userotp=Session::get('user_otp');
            $data=User::find($userid);
            if ($request['verify']==$userotp) {
               $data->ac_status=1;
               $data->save();
               return redirect('/home');
            }
            else {
                return redirect('verify')->withError('Incorrect OTP! Please Verify again!');
            }
        }
       
       
        return view('verified', ['page_title' => 'Verify here']);
    }

    public function checkemail(Request $req)  {
        $submit = $req['submit'];
        if (isset($submit)) {
            $req->validate([
                'email'=>'required'
            ]);
            $useremail=User::where('email',$req['email'])->value('email');
            Session::put('useremail',$useremail);
            // Session::put('temp_email',$useremail);
            // return $useremail;
            if ( $useremail==$req['email']) {
                $to=$useremail;
                $otp=rand(100000,999999);
                Session::put('temp_otp',$otp);
                $message="Pictogram forgot password verification:: ";
                $subject="Forgot Password";
            Mail::to($to)->send(new  sendmail($otp,$message,$subject));
            return redirect('/resetpass')->withSent('An OTP has been sent to Your Gmail Account');
            }
            else{
                return redirect('/checkemail')->withError("We Can't find you! Try Again");
            }
        }
        return view('passwordreset.reset',['page_title' => 'Pictogram - Verify Email']);
    }

    public function resetpass(Request $req) {
        $tempotp = Session::get('temp_otp');
        $tempemail=Session::get('useremail');
        $submit = $req['submit'];
        if (isset($submit)) {
            $req->validate([
                'otpcheck'=>'required',
                'new_pass'=>'required'
            ]);

            if ($tempotp==$req['otpcheck']) {
               $pass= Hash::make($req['new_pass']);
                $Save=User::where('email',$tempemail)->update(['password'=>$pass]);
                Session::flush();
                return redirect()->route('login')->withSuccess('You password has been reset');
            }
            else{
                // Session::flush();
                return redirect('/resetpass')->withError('Incorrect OTP!');
            }
        }
        return view('passwordreset.resetpassword',['page_title' => 'Pictogram - Password Reset']);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

   

}
