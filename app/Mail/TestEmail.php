<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $token;
    public function __construct($token)
    {
        $this->token  = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $address = 'janeexampexample@example.com';
        // $subject = 'This is a demo!';
        // $name = 'Jane Doe';

        return $this->view('emails.resetpassword')->subject("RESET PASSWORD REQUEST")->with([ 'token' => $this->token ]);
                    // ->from($address, $name)
                    // ->cc($address, $name)
                    // ->bcc($address, $name)
                    // ->replyTo($address, $name)
                    // ->subject($subject)
                    // ->with([ 'test_message' => $this->data['message'] ]);
    }
}
