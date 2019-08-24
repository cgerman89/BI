<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordTemporal extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Password Temporal JossBI';

    public $msg;

    /**
     * Create a new message instance.
     * @param $msg
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.password_temporal');
    }
}
