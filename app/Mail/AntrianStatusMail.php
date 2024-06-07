<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AntrianStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $konfirmasi,$name,$dept_tujuan,$status
    )
    {
        $this->konfirmasi = $konfirmasi;
        $this->name = $name;
        $this->dept_tujuan = $dept_tujuan;
        $this->status = $status;
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
                   ->view('emails.AntrianStatus')
                   ->subject($this->konfirmasi)
                   ->with(
                    [
                        'name' => $this->name,
                        'dept_tujuan' => $this->dept_tujuan,
                        'status' => $this->status,
                    ]);
    }
}
