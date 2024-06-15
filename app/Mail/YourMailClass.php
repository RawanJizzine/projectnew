<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class YourMailClass extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $recipients;
    public function __construct($message,$recipients)
    {
        $this->recipients = $recipients;
       $this->message=$message;
    }


    public function build()
    {

    
     $newmessage=$this->message;
    
     
        return $this->view('content.dashboard.message.emails',compact('newmessage'))
                    ->subject('New Letter')
                    ->to($this->recipients);
                  

    }




   
}
