<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$kode_reset)
    {
        $this->user = $user;
        $this->kode_reset = $kode_reset;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
                    ->view('backend.users.reset_password_mail')
                    ->subject('Reset Password')
                    ->with(
                        [
                            'name' => $this->user,
                            'kode_reset' => $this->kode_reset
                        ]
                    );
    }
}
