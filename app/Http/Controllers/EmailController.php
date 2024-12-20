<?php

namespace App\Http\Controllers;

use App\Mail\sendmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    public function sendEmail(){
        $to = "singhshivamrock2@gmail.com";
        $message = "Your otp is:: ";
        $subject = "Verification Code";

      Mail::to($to)->send(new  sendmail($message,$subject)); 
        // dd($req);      
    }
}
