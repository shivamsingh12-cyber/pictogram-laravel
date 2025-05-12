<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\likepost;
use App\Models\Post;
use App\Models\User;
use App\Models\admin;
use App\Models\follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    public function adminlogin(Request $req) {

        try {
            $submit = $req['submit'];
            if ($submit == "submit") {
              
    
                $req->validate([
                    'email' => 'required',
                    'password' => 'required'
                ]);
              
           
                $query=admin::where('email',$req->email)->where('password',$req->password)->first();
                if($query){
                    return redirect('/adminhome');
                }
                else
                    return redirect('/admin')->withError('Incorrect Username or Password');
                
            }else{
                return view('admin.login');
            }
            
        }  catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Server error: ' . $e->getMessage()
                ], 500);
            }
            
    }  
     
    public function table() {
        $getuser=User::orderBy('id','desc')->get();
        $likes = likepost::all();
        $comments=Comment::all();
        $posts=Post::all();

        return view('admin.dashboard',['getuser'=>$getuser,'alllikes'=>$likes,'allcomments'=>$comments,'AllPosts'=>$posts]);
    }
    public function userpage($id) {


        $getuser=User::find($id);

        $posts = DB::table('posts')
        ->select('posts.id as postid','posts.*','users.id','users.first_name','users.last_name','users.profile_pic','users.username')
        ->join('users','users.id','=','posts.user_id')->orderBy('users.id','desc')
        ->get();

        $listpost=array();
        foreach ($posts as $post) {
            // return $post;
            $followquery=follower::where([
                ['follower_id',$id],
                ['user_id',$post->user_id]
                 ])->get();
                    if ($followquery->count() || $post->user_id==$id) {
                             $listpost[]= $post;
                           
                    }
                 
        }

            // sidebar
        $users=User::where('id','!=',$id)->limit(3)->get();
        
        // for follow suggestion
        $filter=array();
        foreach ($users as $user) {
            $followquery=follower::where([
                ['follower_id',$id],
                ['user_id',$user->id]
                 ])->get();
                    if (empty($followquery->count()) && count($filter)<3) {
                             $filter[]= $user;
                           
                    }
                 
        }
    //    $user=$users;
                
                    // return $filter_list;

       return view('mainpage.home', ['page_title' => 'Pictogram - Home','posts'=>$listpost,'users'=>$filter,'getusers'=>$user]);

    }
    
 
    
    public function admindashboard($id)
    {
      // Store original admin ID before impersonation
    Session::put('original_admin', Auth::id());
    
    // Get the user to impersonate
    $user = User::findOrFail($id);
    
    // Login as the target user
    Auth::login($user);
    
    return redirect('/home');
     
       
    //    return view('mainpage.home');

    }

    public function blockuser($id){
        $userblock=User::find($id);

        if ($userblock->ac_status==0) {
            $userblock->ac_status=1;
            $userblock->save();
            return redirect('/adminhome');
        }
        if ($userblock->ac_status==1) {
            $userblock->ac_status=2;
            $userblock->save();
            return redirect('/adminhome');
        }
        
        else if ($userblock->ac_status==2) {
            $userblock->ac_status=1;
            $userblock->save();
            return redirect('/adminhome');
        }
      
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }
}

