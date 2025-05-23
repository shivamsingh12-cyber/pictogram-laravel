<?php

namespace App\Http\Controllers;


use App\Models\notify;
use DB;
use Session;
use App\Models\Post;
use App\Models\User;
use App\Mail\sendmail;
use App\Models\Comment;
use App\Models\follower;
use App\Models\likepost;
use App\Models\Notification;
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
                'username' => 'required|unique:users,username',
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
       
            if (Auth::attempt(array($fieldType => $req['email'], 'password' => $req['password']))) {
             
                // $_SESSION['user']=Auth::user();
                if (Auth::check() && Auth::user()->ac_status==2) {
                  
                return view('blocked',['page_title' => 'Block Page']);
                }
                if (Auth::check() && Auth::user()->ac_status==0) {
                    $to=Auth::user()->email;
                    $userid=Auth::user()->id;
                    Session::put('userid',$userid);
                    $otp=rand(100000,999999);
                    Session::put('user_otp',$otp);
                    $message="Pictogram Verification OTP is:: ";
                    $subject="Pictogram Verification";
                    // User::where('id',$userid)->update(['profile_pic'=>'default_pic.jpg']);
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
        $posts = DB::table('posts')
        ->select('posts.id as postid','posts.*','users.id','users.first_name','users.last_name','users.profile_pic','users.username')
        ->join('users','users.id','=','posts.user_id')->orderBy('posts.id','desc')
        ->get();

        $listpost=array();
        foreach ($posts as $post) {
            // return $post;
            $followquery=follower::where([
                ['follower_id',Auth()->id()],
                ['user_id',$post->user_id]
                 ])->get();
                    if ($followquery->count() || $post->user_id==Auth()->id()) {
                             $listpost[]= $post;
                           
                    }
                 
        }

            // return $posts;
        $users=User::where('id','!=',Auth()->id())->limit(3)->get();
        
        // for follow suggestion
        $filter=array();
        foreach ($users as $user) {
            $followquery=follower::where([
                ['follower_id',Auth()->id()],
                ['user_id',$user->id]
                 ])->get();
                    if (empty($followquery->count()) && count($filter)<3) {
                             $filter[]= $user;
                           
                    }
                 
        }
    //    $user=$users;
                
                    // return $filter_list;

       return view('mainpage.home', ['page_title' => 'Pictogram - Home','posts'=>$listpost,'users'=>$filter]);

    }
    public function admindashboard($id)
    {
        
        $posts = DB::table('posts')
        ->select('posts.id as postid','posts.*','users.id','users.first_name','users.last_name','users.profile_pic','users.username')
        ->join('users','users.id','=','posts.user_id')->orderBy('posts.id','desc')
        ->get();

        $listpost=array();
        foreach ($posts as $post) {
            // return $post;
            $followquery=follower::where([
                ['follower_id',Auth()->id()],
                ['user_id',$post->user_id]
                 ])->get();
                    if ($followquery->count() || $post->user_id==Auth()->id()) {
                             $listpost[]= $post;
                           
                    }
                 
        }

            // return $posts;
        $users=User::where('id','!=',Auth()->id())->limit(3)->get();
        
        // for follow suggestion
        $filter=array();
        foreach ($users as $user) {
            $followquery=follower::where([
                ['follower_id',Auth()->id()],
                ['user_id',$user->id]
                 ])->get();
                    if (empty($followquery->count()) && count($filter)<3) {
                             $filter[]= $user;
                           
                    }
                 
        }
    //    $user=$users;
                
                    // return $filter_list;

       return view('mainpage.home', ['page_title' => 'Pictogram - Home','posts'=>$listpost,'users'=>$filter]);

    }

    public function follow(Request $req) {
       $current_user=Auth()->id();
            $user=$req->json('user_id');
            // return $user;
       $query= follower::create([
        'follower_id'=>$current_user,
        'user_id'=>$user
       ]);
        if ($query) {
            return response()->json([
                'response'=>true,
            ]);
        }
        else {
            return response()->json([
                'response'=>false
            ]);
        }
       
    }
    public function unfollow(Request $req) {
       $current_user=Auth()->id();
            $user=$req->json('user_id');
            // return $user;
       $query= follower::where([
        ['follower_id',$current_user],
        ['user_id',$user]
       ]);
       $query->delete();
        if ($query) {
            return response()->json([
                'response'=>true,
            ]);
        }
        else {
            return response()->json([
                'response'=>false
            ]);
        }
       
    }
    public function likepost(Request $req) {
           $current_user=Auth()->id();
           $post_id=$req->json('post_id');
           $getuser=$req->json('get_user');

           
          $checkstatus=likepost::where([
            ['user_id',$current_user],
            ['post_id',$post_id]
          ])->count();
          
       
          if (!$checkstatus) {
            $query= likepost::create([
             'post_id'=>$post_id,
             'user_id'=>$current_user,
             'action'=>'like'
            ]);

            $notification = notify::create([
                'user_id'=> $current_user,
                'postlike'=> $post_id,
                'u_postid'=> $getuser,
                'type'=>'like'
            ]);

                if ($query) {
                    return response()->json([
                            'response'=>true,
                        ]);
                }
                    else {
                        return response()->json([
                            'response'=>false
                        ]);
                    }
          }
 
       
    }
    public function unlikepost(Request $req) {
           $current_user=Auth()->id();
           $post_id=$req->json('post_id');

           
    
          
          $deletelike=likepost::where([
            ['user_id',$current_user],
            ['post_id',$post_id],
           ]);
           $deletelike->delete();
    
          if ($deletelike) {
                if ($deletelike) {
                    return response()->json([
                            'response'=>true,
                        ]);
                }
                else {
                    return response()->json([
                        'response'=>false
                    ]);
                }
          }
       
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

    public function editprofile(Request $req)
    {
      
        $submit=$req['submit'];
        if (isset($submit)) {

            $file= $req->file('image');
            if (file_exists($file)) {
                $filename=$file->getClientOriginalName();
                $path=$file->storeAs('profile',$filename,'public');
            }
            else
                $path='profile/men.jpg';

            $req->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'username' => 'required',
            ]);
       
            
               if (count(User::select('username')->where([['username',$req['username']],['id','!=',Auth()->id()]])->get())==0) {
                    $username=$req['username'];
                
               } 
               else {
                $req->validate([
                    'username' => 'unique:users,username'
                ]);
               }
               if (isset($req['password'])) {
                    $password=  Auth::user()->password;
               }
               else
                    $password=Hash::make($req['password']);

                    User::where('email',Auth::user()->email)->update([
                        'first_name'=>$req['first_name'],
                        'last_name'=>$req['last_name'],
                        'gender'=>$req['gender'],
                        'username'=>$username,
                        'password'=>$password,
                        'profile_pic'=>$path
                    ]);
                    return redirect()->route('edit_profile')->withSuccess('Yeah! We Got Your Updated Data');
        }
            return view('mainpage.editprofile',['page_title' => 'Pictogram - Edit Profile']);
    }

    public function addposts(Request $req) {
        $submit=$req['submit'];
        if (isset($submit)) {
            $req->validate([
                'post_img'=>'required'
            ]);
            $file= $req->file('post_img');
       
            $filename=$file->getClientOriginalName();
            $path=$file->storeAs('posts',$filename,'public');
            $text= $req['post_text'];

            $posts = new Post; 

            $posts->user_id = Auth()->id();
            $posts->post_img = $path;
            $posts->post_text = $text;
            $posts->save();
            return redirect('/')->withSuccess('You Post has been Created!');
        }
        else
        return "doesn't happen anything";
    }

    public function mainprofile(string $uname) {
        
            $query= User::where('username',$uname)->value('username');
            // return $query;
            $datauser=null;
            if ($uname==$query && Auth()->check()) {
                $data=User::where('username',$uname)->get();
                $posts=Post::where('user_id',$data[0]['id'])->get();

                $getfollowers=follower::where('user_id',$data[0]['id'])->get();
                $getfollowing=follower::where('follower_id',$data[0]['id'])->get();
                // $checklfollower=follower::select('follower_id')->where('');
                // return $allfollower;
                $followstatus=follower::where([
                    ['follower_id',Auth()->id()],
                    ['user_id',$data[0]['id']]
                     ])->get();
                 
        
                   
                     $getdata=array();
                     foreach($getfollowers as $follower){
                    
                        
                         $getdata=DB::table('users')
                         ->select('users.*','followers.follower_id','followers.user_id')
                         ->join('followers','users.id','=','followers.follower_id')->where('followers.user_id',$data[0]['id'])->get();
                  
                     }
                    //  return $getdata;
                     $getdata1=array();
                     foreach($getfollowing as $following){
                        // $getdata1[]=User::where('id',$following['user_id'])->get();

                        $getdata1=DB::table('users')
                        ->select('users.*','followers.follower_id','followers.user_id')
                        ->join('followers','users.id','=','followers.user_id')->where('followers.follower_id',$data[0]['id'])->get();
                     }
                        //    return $getdata1;
                    
        
                   
            return view('mainpage.mainprofile',['page_title'=>Auth::user()->first_name.' '.Auth::user()->last_name,'userdata'=>$data,'posts'=>$posts,'followers'=>$getfollowers,'followings'=>$getfollowing,'followstatus'=>$followstatus,"followerpeople"=>$getdata,'followingpeople'=>$getdata1]);
            }
            else
            return view('mainpage.nouser',['page_title' => 'Pictogram - No User']);
    }

    //add comments in post
    public function addcomment(Request $req) {
        $comment= $req->json('comment');
        $post_id= $req->json('post_id');
        $current_user=Auth()->id();
        $getuser=$req->json('get_user');

       
        $query= Comment::create([
            'post_id'=>$post_id,
            'user_id'=>Auth()->id(),
            'comment'=>$comment
           ]);

           $notification = notify::create([
            'user_id'=> $current_user,
            'postlike'=> $post_id,
            'u_postid'=> $getuser,
            'type'=>'comment'
        ]);
 
       if ($query) {
        $cuser=getallUser(Auth()->id());
                 return response()->json([
                         'response'=>true,
                         'comments'=>'<div class="d-flex align-items-center p-2">
                                <div><img src="/storage/'.$cuser['profile_pic'].'" alt="" height="40" class="rounded-circle border">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-start">
                                    <h6 style="margin: 0px;"><a href="/mainprofile/'.$cuser['username'].'" class="text-decoration-none text-dark">@'.$cuser['username'].'</a></h6>
                                    <p style="margin:0px;" class="text-muted">'.$comment.'</p>
                                </div>
                            </div>',
                     ]);
             
                    }
      else {
    return response()->json([
                            'response'=>false,
                        ]);
                    }
    
 }

 
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

   

}
