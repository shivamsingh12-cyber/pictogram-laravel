<?php

namespace App\Http\Controllers;

use App\Models\notify;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function notify(Request $req) {
            $query=DB::table('notifications')
            ->select('notifications.*','posts.post_text','users.username','users.profile_pic')
            ->join('posts','posts.id','=','notifications.postlike')->join('users','users.id','=','notifications.user_id')->where([
                ['posts.user_id',Auth()->id()],
                ['notifications.status','unseen']])->orderBy('notifications.id','desc')
            ->get();
            $totalrow=$query->count();
            if ($totalrow > 0) {
                foreach ($query as $row) {
                    $user_name='';
                    if ($row['user_id']==Auth()->id()) {
                       $user_name='<img src="./storage/'.$row->profile_pic.'" class="img-thumbnail" width="40" height="40"/>You have';
                    }
                }
            }
        
     }
     public function shownotification(Request $req) {

        $notify=notify::where('status',$req->json('status'))->join('users','users.id','=','notifies.user_id')->join('posts','posts.id','=','notifies.postlike')->select('notifies.*','users.id','users.username as username','posts.*')->get();
       
       if ($notify) {        
                 return response()->json(['current_user'=>Auth()->id(),'data'=>$notify,'total'=>count($notify)]);
       }
    }

     public function closenotification(Request $req) {

        try {
            // Update all existing notifications instead of creating new ones
            $updated = notify::where('type', 'like')
                             ->update(['status' => 0]);
    
            return response()->json([
                'success' => true,
                'message' => 'Notifications marked as read',
                
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
}
