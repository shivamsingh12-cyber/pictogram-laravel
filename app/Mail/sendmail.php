<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $mailmessage;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return $this
     */
    public function __construct($message, $subject)
    {
        $this->mailmessage=$message;
        $this->subject=$subject;
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
