<?php

namespace App\Http\Controllers;

use App\Models\chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChattingController extends Controller
{
    public function getActiveChatUserId() {

        try {
                $current_user=Auth()->id();
                $query = chat::select('from_user_id', 'to_user_id')->where('to_user_id', $current_user)
                ->orWhere('from_user_id', $current_user)->orderBy('id','desc')
                ->get();
                    $ids=array();
                    foreach ($query as $ch) {
                        if ($ch['from_user_id']!=$current_user && !in_array($ch['from_user_id'],$ids)) {
                           $ids[]=$ch['from_user_id'];
                        }
                        if ($ch['to_user_id']!=$current_user && !in_array($ch['to_user_id'],$ids)) {
                           $ids[]=$ch['to_user_id'];
                        }
                    }
                    return $ids;
           
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
    public function getMessages($id) {

        try {
                $current_user=Auth()->id();
                $query = Chat::where('to_user_id', $current_user)
                ->where('from_user_id', $id)
                ->orWhere('from_user_id', $current_user)
                ->where('to_user_id', $id)->orderByDesc('id')
                ->get();
    
                    // $ids=array();
                    // foreach ($query as $ch) {
                    //     if ($ch['from_user_id']!=$current_user && !in_array($ch['from_user_id'],$ids)) {
                    //        $ids[]=$ch['from_user_id'];
                    //     }
                    //     if ($ch['to_user_id']!=$current_user && !in_array($ch['to_user_id'],$ids)) {
                    //        $ids[]=$ch['to_user_id'];
                    //     }
                    // }
                    return $query;
           
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
    public function getAllMessages() {

        try {
            $active_chat_id= $this->getActiveChatUserId();
            $conversation=array();
            foreach ($active_chat_id as $index => $id) {
                $conversation[$index]['user_id']=$id;
                $conversation[$index]['messages']=$this->getMessages($id);
            }
            return $conversation;
           
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
    public function getuser($id) {

        try {
        $getuser= User::find($id);
        return $getuser;
           
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
    public function getchats(Request $req) {

        try {
                $chats= $this->getAllMessages();
                $chatlist  = "";
                foreach ($chats as  $chat) {
                    $ch_user = $this->getuser($chat['user_id']);
                    $chatlist.='<div class="d-flex align-items-center chat-item chatlist_item" data-bs-toggle="modal" data-bs-target="#chatting" onclick="popchat('.$chat['user_id'].')">
            <img src="/storage/'.$ch_user['profile_pic'].' " alt="User" class="chat-dp">
            <div class="chat-details ms-3">
                <div class="d-flex justify-content-between">
                    <span class="chat-name">'.$ch_user['first_name'].' '.$ch_user['last_name'].'</span>
                    <span class="chat-time">'.getTimeAgo($chat['messages'][0]['created_at']).'</span>
                </div>
                <div class="chat-message">'.$chat['messages'][0]['msg'].'</div>
            </div>
        </div>'; 
    }
    $json['chatlist']=$chatlist;
    $user=$req->json('chatter_id');
    if (isset($user) && $user!=0) {
           $messages = $this->getMessages($user);
           $chatmsg="";
           foreach($messages as $cm){
            if ($cm['from_user_id']==Auth::id()) {
               $cl1=' align-self-end bg-primary text-light';
               $cl2=' text-light';
            }
            else{
                $cl1='';
                $cl2=' text-muted';
            }
        //    $chatmsg.='<div class="chat-box">
        //     <div class="chat-box-body">
        //       <div class="chat-box-body-content gap-3 d-flex flex-column">
        //         <div class="chat-box-message p-2 rounded shadow-sm col-8 d-inline-block '.$cl1.'">
        //           <div class="chat-box-message-content">
        //             <p>'.$cm['msg'].'</p>
        //             <span class="'.$cl2.'" style="font-size: small">'.getTimeAgo($cm['created_at']).'</span>
        //           </div>
        //         </div>
        //       </div>';
           $chatmsg.='<div class="chat-box-message p-2 rounded shadow-sm col-8 d-inline-block '.$cl1.'">
                  <div class="chat-box-message-content">
                    <p>'.$cm['msg'].'</p>
                    <span class="'.$cl2.'" style="font-size: small">'.getTimeAgo($cm['created_at']).'</span>
                  </div>
                </div>';
            }
            $json['chat']['msgs']=$chatmsg;
            $json['chat']['userdata']=$this->getuser($user);
}
else{
    $json['chat']['msgs']='<div class="spinner-grow text-danger" role="status">
</div>';
}
    return response()->json($json);
           
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function sendMessage(Request $req){
                $current_user_id = Auth::id();
                $user_id = $req->input('user_id');  // Use input() instead of json()
                $msg = $req->input('msg');
                $query= chat::create([
                    'from_user_id' => $current_user_id,
                    'to_user_id' => $user_id,
                    'msg' => $msg
                ]);
                if ($query) {
                    return response()->json(['success' => true, 'message' => 'Message sent successfully']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Failed to send message'], 500);
                }
    }

    
}
