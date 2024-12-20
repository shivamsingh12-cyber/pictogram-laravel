<?php

namespace App\Http\Controllers;

use App\Mail\sendmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    public function sendEmail(){
        $toEmail = "singhshivamrock2@gmail.com";
        $message = "Hello, Welcome my friend";
        $subject = "Verification Code";

       $request= Mail::to($toEmail)->send(new sendmail($message,$subject));
       dd($request);
    }
}
