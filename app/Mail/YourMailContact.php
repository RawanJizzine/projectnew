<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class YourMailContact extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $message;
    public $recipients;
    public function __construct($name,$email,$message,$recipients)
    {
        $this->name = $name;
       $this->email=$email;
        $this->recipients = $recipients;
       $this->message=$message;
    }


    public function build()
    {

    
     $newmessage=$this->message;
     $newname=$this->name;
     $newemail=$this->email;
    
     
        return $this->view('content.front-page.messageContactMessage',compact('newmessage', 'newname', 'newemail'))
                    ->subject('New Message')
                    ->to($this->recipients);
                  

    }



}
