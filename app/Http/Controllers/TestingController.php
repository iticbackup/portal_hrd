<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\IjinAbsenNotif;
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
}
