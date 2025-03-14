<?php

namespace App\Http\Controllers;

use App\Models\chat;
use Auth;
use Illuminate\Http\Request;

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
}
