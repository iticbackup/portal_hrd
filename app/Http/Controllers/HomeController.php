<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Models\IjinKeluarMasuk;
use App\Models\IjinAbsen;
use \Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        Antrian $antrian,
        IjinKeluarMasuk $ijin_keluar_masuk,
        IjinAbsen $ijin_absen
    )
    {
        $this->middleware('auth');
        $this->antrian = $antrian;
        $this->ijin_keluar_masuk = $ijin_keluar_masuk;
        $this->ijin_absen = $ijin_absen;
        $this->addDay = 0;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $live_date = Carbon::now()->addDay($this->addDay);
        $data['antrian'] = $this->antrian->select('no_urut')
                                        ->where('status','Terpanggil')
                                        ->where('tgl_input','like','%'.$live_date->format('Y-m-d').'%')
                                        ->orderBy('updated_at','desc')
                                        ->first();
        if (empty($data['antrian'])) {
            $data['no_antrian'] = 0;
        }else{
            $data['no_antrian'] = $data['antrian']['no_urut'];
        }

        $data['sisa_antrian_hari_ini'] = $this->antrian->where('tgl_input','like','%'.$live_date->format('Y-m-d').'%')
                                                ->whereIn('status',['Waiting'])
                                                ->count();
        $data['ijin_keluar_masuks'] = $this->ijin_keluar_masuk->with('ijin_keluar_masuk_ttd')->whereHas('ijin_keluar_masuk_ttd', function($ikmt){
                                                                    $ikmt->where('signature_manager','like','%'.auth()->user()->nik.'%')
                                                                        ->orWhere('signature_personalia','like','%'.auth()->user()->nik.'%')
                                                                        ->orWhere('signature_kend_satpam','like','%'.auth()->user()->nik.'%');
                                                                })
                                                                ->whereDate('created_at',$live_date->format('Y-m-d'))
                                                                ->orderBy('created_at','desc')
                                                                ->get();
        $data['ijin_absens'] = $this->ijin_absen->with('ijin_absen_ttd')->whereHas('ijin_absen_ttd', function($iat){
                                                    $iat->where('signature_manager','like','%'.auth()->user()->nik.'%')
                                                        ->orWhere('signature_bersangkutan','like','%'.auth()->user()->nik.'%')
                                                        ->orWhere('signature_saksi_1','like','%'.auth()->user()->nik.'%')
                                                        ->orWhere('signature_saksi_2','like','%'.auth()->user()->nik.'%');
                                                })
                                                ->whereDate('created_at',$live_date->format('Y-m-d'))
                                                ->orderBy('created_at','desc')
                                                ->get();
        return view('home',$data);
    }
}
