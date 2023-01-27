<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class singleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    
    public function build()
    {
        $subject = $this->data['subject'];
        $content= $this->data['content'];
        $cc = $this->data['cc'];
         return $this->subject($subject)
                    ->cc($cc)
                    ->html($content);
//        return $this->view('view.name');
    }
}
