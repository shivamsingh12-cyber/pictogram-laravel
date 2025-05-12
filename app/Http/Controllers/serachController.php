<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class serachController extends Controller
{
    public function search(Request $request){
        $search = $request->input('srch');
        $users = User::where('username','like',$search.'%')->orderBy('username','desc')->get();
        $opt='';
        if (count($users) > 0) {
            $opt = '<ul class="list-group">';
            foreach ($users as $user) {
                $opt .= '<li class="list-group-item"><a href="/mainprofile/'.$user->username.'">'.$user->username.'</a></li>';
            }
            $opt .= '</ul>';
        }
        else{
            $opt = '<li class="alert alert-danger">No user found</li>';
        }
        return response($opt);
    }
}
