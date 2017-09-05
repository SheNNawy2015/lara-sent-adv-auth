<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $firstName;
    protected $email;
    protected $code;

    public function __construct($fname, $email, $resetCode)
    {
        $this->firstName = $fname;
        $this->email = $email;
        $this->code = $resetCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.reset-password', [
            'username'  => $this->firstName,
            'email'     => $this->email,
            'code'      => $this->code
        ]);
    }
}
