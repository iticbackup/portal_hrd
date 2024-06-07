<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use \Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        Antrian $antrian
    )
    {
        $this->middleware('auth');
        $this->antrian = $antrian;
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
        return view('home',$data);
    }
}
