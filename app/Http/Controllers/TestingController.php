<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\IjinAbsenNotif;
use App\Mail\IjinKeluarMasukNotif;
use App\Mail\TestingMarkdown;
use \Carbon\Carbon;
use Mail;
use PDF;

class TestingController extends Controller
{
    public function testing()
    {
        $customPaper = array(0,0,812.5,378);
        $pdf = PDF::loadView('backend.testing.suratpermohonanijinabsen');
        $pdf->setPaper($customPaper);
        return $pdf->stream();
    }

    public function testing_mail_ijin_absen()
    {
        Mail::to('rioanugrah999@gmail.com')
            ->send(new IjinAbsenNotif(
                'Konfirmasi Ijin Absen',
                '002-20240618',
                'Rio Anugrah Adam Saputra',
                'Staff',
                'IT',
                'rioanugrah999@gmail.com',
                'Rabu',
                '19 Juni 2024',
                '20 Juni 2024',
                '1',
                'Ijin Keperluan Pribadi',
                'Approved',
            ));
    }

    public function testing_mail_ijin_keluar_masuk()
    {
        Mail::to('rioanugrah999@gmail.com')
            ->send(new IjinKeluarMasukNotif(
                'Konfirmasi Ijin Keluar Masuk',
                'Rio',
                '001-32421',
                'Rio Anugrah A.S (2103484)',
                'Staff',
                'IT',
                'Pribadi',
                'Ijin Ke Bank',
                'Pribadi',
                'KL',
                '08:00:00',
                '11:50:00',
                null,
                'Approved',
                'HRD'
        ));
    }

    public function testing_mail_markdown()
    {
        // Mail::to('rioanugrah999@gmail.com')
        //     ->send(new TestingMarkdown());
        // Mail::mailer('mailtrap')->to('rioanugrah999@gmail.com')
        //                         ->send(new TestingMarkdown());
    }
}
