<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AntrianNotifikasiMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $konfirmasi,$nourut,$nik,$name,$email,$departemen,$bagian,$dept_tujuan,$keperluan
    )
    {
        $this->konfirmasi = $konfirmasi;
        $this->nourut = $nourut;
        $this->nik = $nik;
        $this->name = $name;
        $this->email = $email;
        $this->departemen = $departemen;
        $this->bagian = $bagian;
        $this->dept_tujuan = $dept_tujuan;
        $this->keperluan = $keperluan;
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
                   ->view('emails.AntrianNotifikasi')
                   ->subject($this->konfirmasi)
                   ->with(
                    [
                        'nourut' => $this->nourut,
                        'nik' => $this->nik,
                        'name' => $this->name,
                        'email' => $this->email,
                        'departemen' => $this->departemen,
                        'bagian' => $this->bagian,
                        'dept_tujuan' => $this->dept_tujuan,
                        'keperluan' => $this->keperluan,
                    ]);
    }
}
