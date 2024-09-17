<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Models\IjinKeluarMasuk;
use App\Models\IjinAbsen;
use App\Models\User;
use \Carbon\Carbon;
use Jenssegers\Agent\Facades\Agent;

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
    public function index(Request $request)
    {
        if (auth()->user()->no_telp == null) {
            return redirect()->route('profile.setting');
        }
        
        $live_date = Carbon::now()->addDay($this->addDay);
        $data['antrian'] = $this->antrian->select('no_urut')
                                        // ->where('status','Waiting')
                                        ->whereIn('status',['Proses','Selesai','Tolak','Cancel'])
                                        ->whereDate('created_at',$live_date)
                                        ->orderBy('created_at','desc')
                                        ->first();
        if (empty($data['antrian'])) {
            $data['no_antrian'] = 0;
        }else{
            $data['no_antrian'] = $data['antrian']['no_urut'];
        }

        $data['sisa_antrian_hari_ini'] = $this->antrian->whereDate('created_at',$live_date)
                                                ->whereIn('status',['Waiting'])
                                                ->count();
        // $data['ijin_keluar_masuks'] = $this->ijin_keluar_masuk->with('ijin_keluar_masuk_ttd')->whereHas('ijin_keluar_masuk_ttd', function($ikmt){
        //                                                             $ikmt->Where('signature_manager','like','%'.auth()->user()->nik.'%')
        //                                                                 ->orWhere('signature_personalia','like','%'.auth()->user()->nik.'%')
        //                                                                 ->orWhere('signature_kend_satpam','like','%'.auth()->user()->nik.'%');
        //                                                         })
        //                                                         ->whereDate('created_at',$live_date->format('Y-m-d'))
        //                                                         ->orderBy('created_at','desc')
        //                                                         ->get();
        // $data['ijin_absens'] = $this->ijin_absen->with('ijin_absen_ttd')->whereHas('ijin_absen_ttd', function($iat){
        //                                             $iat->Where('signature_manager','like','%'.auth()->user()->nik.'%')
        //                                                 ->orWhere('signature_bersangkutan','like','%'.auth()->user()->nik.'%')
        //                                                 ->orWhere('signature_saksi_1','like','%'.auth()->user()->nik.'%')
        //                                                 ->orWhere('signature_saksi_2','like','%'.auth()->user()->nik.'%');
        //                                         })
        //                                         ->whereDate('created_at','>=',$live_date->format('Y-m-d'))
        //                                         ->orderBy('created_at','desc')
        //                                         ->get();
        // dd($data);
        // if ($request->ajax()) {
        //     $dataIjinKeluarMasuk = $this->ijin_keluar_masuk->whereYear()
        // }
        $start_year_now = $live_date->startOfYear()->format('Y-m');
        $end_year_now = $live_date->endOfYear()->format('Y-m');

        for ($i=$start_year_now; $i <= $end_year_now; $i++) { 
            $data['periode'][] = Carbon::create($i)->isoFormat('MMMM YYYY');
            if (auth()->user()->departemen == 'Administrator') {
                $data['total_ijin_terlambat'][] = $this->ijin_keluar_masuk->where('created_at','LIKE','%'.$i.'%')->where('kategori_izin','TL')->count();
                $data['total_ijin_keluar_masuk'][] = $this->ijin_keluar_masuk->where('created_at','LIKE','%'.$i.'%')->where('kategori_izin','KL')->count();
                $data['total_ijin_pulang_awal'][] = $this->ijin_keluar_masuk->where('created_at','LIKE','%'.$i.'%')->where('kategori_izin','PA')->count();
                $data['total_ijin_absen'][] = $this->ijin_absen->where('created_at','LIKE','%'.$i.'%')->count();
            }else{
                $data['total_ijin_terlambat'][] = $this->ijin_keluar_masuk->where('nik',auth()->user()->nik)->where('created_at','LIKE','%'.$i.'%')->where('kategori_izin','TL')->count();
                $data['total_ijin_keluar_masuk'][] = $this->ijin_keluar_masuk->where('nik',auth()->user()->nik)->where('created_at','LIKE','%'.$i.'%')->where('kategori_izin','KL')->count();
                $data['total_ijin_pulang_awal'][] = $this->ijin_keluar_masuk->where('nik',auth()->user()->nik)->where('created_at','LIKE','%'.$i.'%')->where('kategori_izin','PA')->count();
                $data['total_ijin_absen'][] = $this->ijin_absen->where('nik',auth()->user()->nik)->where('created_at','LIKE','%'.$i.'%')->count();
            }
        }

        return view('home',$data);
    }

    public function updateToken(Request $request)
    {
        // dd($request->all());
        // try{
        //     $request->user()->update(['fcm_token'=>$request->token]);
        //     return response()->json([
        //         'success'=>true
        //     ]);
        // }catch(\Exception $e){
        //     report($e);
        //     return response()->json([
        //         'success'=>false
        //     ],500);
        // }
        // dd(env('FIREBASE_APIKEY'));
        // dd(Agent::browser());
        // $user = User::find(auth()->user()->id);
        // $user->fcm_token = $request->token;
        // $user->save();
        return 'OK';
    }

    public function sendPushNotification(){

        $credentialsFilePath = "firebase/fcm.json";
        $client = new \Google_Client();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $apiurl = 'https://fcm.googleapis.com/v1/projects/'.env('FIREBASE_PROJECTID').'/messages:send';
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();
        $access_token = $token['access_token'];
        
        $headers = [
             "Authorization: Bearer $access_token",
             'Content-Type: application/json'
        ];
        $test_data = [
            "title" => "TITLE_HERE",
            "description" => "DESCRIPTION_HERE",
        ]; 
        
        $data['data'] =  $test_data;
    
        $data['token'] = $user['fcm_token']; // Retrive fcm_token from users table
    
        $payload['message'] = $data;
        $payload = json_encode($payload);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiurl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_exec($ch);
        $res = curl_close($ch);
        if($res){
            return response()->json([
                          'message' => 'Notification has been Sent'
                   ]);
        }
    }
}
