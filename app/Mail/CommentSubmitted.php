<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommentSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;

    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    public function build()
    {
        return $this->view('content.dashboard.orderData.email')
                    ->with([
                        'comment' => $this->comment,
                    ]);
    }
}