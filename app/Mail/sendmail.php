<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public  $mailmessage;
    public  $otp;
    public $subject;
    

    /**
     * Create a new message instance.
     *
     * @return $this
     */
    public function __construct($otp,$message, $subject)
    {
        $this->mailmessage=$message;
        $this->subject=$subject;
        $this->otp=$otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('sendmail');
           
          
    }
}
