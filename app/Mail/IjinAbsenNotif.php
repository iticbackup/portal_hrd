<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IjinAbsenNotif extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $konfirmasi,
        $no_id,
        $name,
        $jabatan,
        $unit_kerja,
        $email,
        $hari,
        $tgl_mulai,
        $tgl_berakhir,
        $selama,
        $keperluan,
        $status
    )
    {
        $this->konfirmasi = $konfirmasi;
        $this->no_id = $no_id;
        $this->name = $name;
        $this->jabatan = $jabatan;
        $this->unit_kerja = $unit_kerja;
        $this->email = $email;
        $this->hari = $hari;
        $this->tgl_mulai = $tgl_mulai;
        $this->tgl_berakhir = $tgl_berakhir;
        $this->selama = $selama;
        $this->keperluan = $keperluan;
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
                    ->view('emails.IjinAbsenNotif')
                    ->subject($this->konfirmasi)
                    ->with([
                        'no_id' => $this->no_id,
                        'name' => $this->name,
                        'jabatan' => $this->jabatan,
                        'unit_kerja' => $this->unit_kerja,
                        'email' => $this->email,
                        'hari' => $this->hari,
                        'tgl_mulai' => $this->tgl_mulai,
                        'tgl_berakhir' => $this->tgl_berakhir,
                        'selama' => $this->selama,
                        'keperluan' => $this->keperluan,
                        'status' => $this->status,
                    ]);
    }
}
