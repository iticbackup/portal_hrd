<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IjinKeluarMasukNotifV1 extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $konfirmasi,
        $name,
        $no_id,
        $nama_karyawan,
        $jabatan,
        $unit_kerja,
        $jenis_keperluan,
        $keperluan,
        $kendaraan,
        $kategori_izin,
        $jam_kerja,
        $jam_rencana_keluar,
        $jam_datang,
        $status,
        $departemen
    )
    {
        $this->konfirmasi = $konfirmasi;
        $this->name = $name;
        $this->no_id = $no_id;
        $this->nama_karyawan = $nama_karyawan;
        $this->jabatan = $jabatan;
        $this->unit_kerja = $unit_kerja;
        $this->jenis_keperluan = $jenis_keperluan;
        $this->keperluan = $keperluan;
        $this->kendaraan = $kendaraan;
        $this->kategori_izin = $kategori_izin;
        $this->jam_kerja = $jam_kerja;
        $this->jam_rencana_keluar = $jam_rencana_keluar;
        $this->jam_datang = $jam_datang;
        $this->departemen = $departemen;
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
        return $this->markdown('emails.IjinKeluarMasukNotif')
                    ->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
                    ->subject($this->konfirmasi)
                    ->with(
                        [
                            'name' => $this->name,
                            'no_id' => $this->no_id,
                            'nama_karyawan' => $this->nama_karyawan,
                            'jabatan' => $this->jabatan,
                            'unit_kerja' => $this->unit_kerja,
                            'jenis_keperluan' => $this->jenis_keperluan,
                            'keperluan' => $this->keperluan,
                            'kendaraan' => $this->kendaraan,
                            'kategori_izin' => $this->kategori_izin,
                            'jam_kerja' => $this->jam_kerja,
                            'jam_rencana_keluar' => $this->jam_rencana_keluar,
                            'jam_datang' => $this->jam_datang,
                            'status' => $this->status,
                            'dept_tujuan' => $this->departemen,
                        ]);
    }
}
