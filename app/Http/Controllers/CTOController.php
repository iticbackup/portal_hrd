<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CarTravelOrder;
use App\Models\BiodataKaryawan;
use \Carbon\Carbon;

use Validator;
use DataTables;

class CTOController extends Controller
{
    function __construct(
        BiodataKaryawan $biodata_karyawan,
        CarTravelOrder $car_travel_order
    ){
        $this->biodata_karyawan = $biodata_karyawan;
        $this->car_travel_order = $car_travel_order;

        $this->middleware('permission:cto-list', ['only' => ['index']]);
        $this->middleware('permission:cto-detail', ['only' => ['detail']]);
        $this->middleware('permission:cto-store', ['only' => ['create','simpan']]);
        $this->middleware('permission:cto-edit', ['only' => ['edit']]);
        $this->middleware('permission:cto-update', ['only' => ['update']]);
        $this->middleware('permission:cto-verifikasi', ['only' => ['validasi','validasi_simpan']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (auth()->user()->getRoleNames()[0] == 'Administrator' || auth()->user()->getRoleNames()[0] == 'HRGA Admin' || auth()->user()->getRoleNames()[0] == 'Satpam') {
                $data = $this->car_travel_order->all();
            }else{
                $data = $this->car_travel_order->where('ttd_pemakai','LIKE','%'.auth()->user()->nik.'%')->get();
            }
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('tanggal_buat', function($row){
                                return Carbon::create($row->tanggal_buat)->isoFormat('DD MMMM YYYY');
                            })
                            ->addColumn('no_polisi', function($row){
                                return explode('-',$row->no_polisi)[0].explode('-',$row->no_polisi)[1].explode('-',$row->no_polisi)[2];
                            })
                            ->addColumn('driver', function($row){
                                return $row->biodata_karyawan->nama;
                            })
                            ->addColumn('status', function($row){
                                switch ($row->status) {
                                    case 'Verifikasi':
                                        return '<span class="badge bg-warning">Menunggu Verifikasi</span>';
                                        break;
                                    case 'On Going':
                                        return '<span class="badge bg-info">On Going</span>';
                                        break;
                                    case 'Verified':
                                        return '<span class="badge bg-success">Verifikasi Berhasil</span>';
                                        break;
                                    case 'Rejected':
                                        return '<span class="badge bg-danger">Gagal Verifikasi</span>';
                                        break;
                                    default:
                                        break;
                                }
                            })
                            ->addColumn('action', function($row){
                                $btn = "<div>";
                                if(auth()->user()->can('cto-detail')){
                                    $btn = $btn."<a class='btn btn-success mb-2 me-2' href=".route('b_cto.detail',['id' => $row->id]).">
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'>
                                                    <path fill='currentColor' fill-rule='evenodd' d='M2 12c.945-4.564 5.063-8 10-8s9.055 3.436 10 8c-.945 4.564-5.063 8-10 8s-9.055-3.436-10-8m10 5a5 5 0 1 0 0-10a5 5 0 0 0 0 10m0-2a3 3 0 1 0 0-6a3 3 0 0 0 0 6' />
                                                </svg> Detail</a>";
                                }
                                switch ($row->status) {
                                    case 'Verifikasi':
                                    case 'On Going':
                                        // if (auth()->user()->getRoleNames()[0] == 'Administrator' || auth()->user()->getRoleNames()[0] == 'HRGA Admin' || auth()->user()->getRoleNames()[0] == 'Satpam') {
                                        // }
                                        if(auth()->user()->can('cto-verifikasi')){
                                            $btn = $btn."<a class='btn btn-primary mb-2 me-2' href=".route('b_cto.validasi',['id' => $row->id]).">
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'>
                                                        <path fill='currentColor' fill-rule='evenodd' d='M4.252 14H4a2 2 0 1 1 0-4h.252c.189-.734.48-1.427.856-2.064l-.18-.179a2 2 0 1 1 2.83-2.828l.178.179A8 8 0 0 1 10 4.252V4a2 2 0 1 1 4 0v.252c.734.189 1.427.48 2.064.856l.179-.18a2 2 0 1 1 2.828 2.83l-.179.178c.377.637.667 1.33.856 2.064H20a2 2 0 1 1 0 4h-.252a8 8 0 0 1-.856 2.064l.18.179a2 2 0 1 1-2.83 2.828l-.178-.179a8 8 0 0 1-2.064.856V20a2 2 0 1 1-4 0v-.252a8 8 0 0 1-2.064-.856l-.179.18a2 2 0 1 1-2.828-2.83l.179-.178A8 8 0 0 1 4.252 14M9 10l-2 2l4 4l6-6l-2-2l-4 4z' />
                                                    </svg> Verifikasi</a>";
                                        }
                                        break;
                                    case 'Verified':
                                        // $btn = $btn."<a class='btn btn-danger mb-2 me-2'>
                                        //         <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 512 512'>
                                        //             <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='m432 144l-28.67 275.74A32 32 0 0 1 371.55 448H140.46a32 32 0 0 1-31.78-28.26L80 144' />
                                        //             <rect width='448' height='80' x='32' y='64' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' rx='16' ry='16' />
                                        //             <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='M312 240L200 352m112 0L200 240' />
                                        //         </svg> Delete</a>";
                                        break;
                                    case 'Rejected':
                                        $btn = $btn."<a class='btn btn-warning mb-2 me-2' href=".route('b_cto.edit',['id' => $row->id]).">
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 512 512'>
                                                        <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='44' d='M358.62 129.28L86.49 402.08L70 442l39.92-16.49l272.8-272.13zm54.45-54.44l-11.79 11.78l24.1 24.1l11.79-11.79a16.51 16.51 0 0 0 0-23.34l-.75-.75a16.51 16.51 0 0 0-23.35 0' />
                                                    </svg> Edit</a>";
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }
                                $btn = $btn."</div>";
    
                                return $btn;
                            })
                            ->rawColumns(['status','action'])
                            ->make(true);
        }
        return view('backend.cto.index');
    }

    public function create()
    {
        // $data['drivers'] = $this->biodata_karyawan->where('satuan_kerja',21)
        // $live_date = Carbon::now()->format('Y-m-d');
        // dd($no_urut = $this->car_travel_order->whereDate('created_at',$live_date)->count());
        $data['biodata_karyawans'] = $this->biodata_karyawan->where('status_karyawan','!=','R')
                                                ->get();
        return view('backend.cto.create',$data);
    }

    public function simpan(Request $request)
    {
        $rules = [
            'tanggal_buat' => 'required',
            'plat_nomor_1' => 'required',
            'plat_nomor_2' => 'required',
            'plat_nomor_3' => 'required',
            'driver' => 'required',
            'jam_berangkat_rencana' => 'required',
            'jam_datang_rencana' => 'required',
            'tujuan_rencana' => 'required',
            'tujuan_aktual' => 'required',
            'keperluan' => 'required',
        ];

        $messages = [
            'tanggal_buat.required' => 'Tanggal Buat Wajib Diisi',
            'plat_nomor_1.required' => 'Plat Nomor Huruf Depan Wajib Diisi',
            'plat_nomor_2.required' => 'Plat Nomor Tengah Wajib Diisi',
            'plat_nomor_3.required' => 'Plat Nomor Huruf Terakhir Wajib Diisi',
            'driver.required' => 'Driver Wajib Diisi',
            'jam_berangkat_rencana.required' => 'Jam Rencana Berangkat Diisi',
            'jam_datang_rencana.required' => 'Jam Rencana Datang Wajib Diisi',
            'tujuan_rencana.required' => 'Tujuan Rencana Wajib Diisi',
            'tujuan_aktual.required' => 'Tujuan Aktual Wajib Diisi',
            'keperluan.required' => 'Keperluan Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $cek_kendaraan = $this->car_travel_order->where('no_polisi',strtoupper($request->plat_nomor_1).'-'.$request->plat_nomor_2.'-'.strtoupper($request->plat_nomor_3))
                                                    ->where('status','Verified')
                                                    ->orderBy('created_at','desc')
                                                    ->first();
            if ($cek_kendaraan) {
                $array_message = array(
                    'success' => false,
                    'message_title' => 'Gagal',
                    'error' => 'Kendaraan No. Polisi '.$cek_kendaraan->no_polisi.' Sedang Dalam Perjalanan',
                );
                return response()->json($array_message);
            }

            $live_date = Carbon::now()->format('Y-m-d');
            $no_urut = $this->car_travel_order->whereDate('created_at',$live_date)->count();
            if ($no_urut == 0) {
                $input['id'] = 'DRV-'.sprintf("%03s",(int)substr('001', 0, 3)).'-'.date('Ymd');
            }else{
                $input['id'] = 'DRV-'.sprintf("%03s",(int)substr($no_urut+1, 0, 3)).'-'.date('Ymd');
            }
            $input['tanggal_buat'] = $request->tanggal_buat;
            $input['no_polisi'] = strtoupper($request->plat_nomor_1).'-'.$request->plat_nomor_2.'-'.strtoupper($request->plat_nomor_3);
            $input['driver_id'] = $request->driver;
            $input['jam_berangkat_rencana'] = $request->jam_berangkat_rencana;
            $input['jam_datang_rencana'] = $request->jam_datang_rencana;
            $input['tujuan_rencana'] = $request->tujuan_rencana;
            $input['tujuan_aktual'] = $request->tujuan_aktual;
            $input['keperluan'] = $request->keperluan;
            $input['penumpang'] = json_encode($request->penumpang);
            $input['ttd_pemakai'] = auth()->user()->nik.'_'.auth()->user()->name.'_'.auth()->user()->departemen.'_'.$input['id'];
            $input['status'] = 'Verifikasi';

            $car_travel_order = $this->car_travel_order->create($input);
            if ($car_travel_order) {
                $message_title="Berhasil !";
                $message_content="Formulir CTO Nomor ID ".$input['id']." Berhasil Dibuat.";
                $message_type="success";
                $message_succes = true;
            }
            $array_message = array(
                'success' => $message_succes,
                'message_title' => $message_title,
                'message_content' => $message_content,
                'message_type' => $message_type,
            );
            return response()->json($array_message);
        }
        return response()->json(
            [
                'success' => false,
                'error' => $validator->errors()->all()
            ]
        );
    }

    public function detail($id)
    {
        $data['cto'] = $this->car_travel_order->find($id);
        if (empty($data['cto'])) {
            return redirect()->back()->with('error','Data Tidak Ditemukan');
        }

        return view('backend.cto.detail',$data);
    }

    public function edit($id)
    {
        $data['cto'] = $this->car_travel_order->find($id);
        if (empty($data['cto'])) {
            return redirect()->back()->with('error','Data Tidak Ditemukan');
        }
        $data['biodata_karyawans'] = $this->biodata_karyawan->where('status_karyawan','!=','R')
                                                            ->get();
        return view('backend.cto.edit',$data);
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'tanggal_buat' => 'required',
            'plat_nomor_1' => 'required',
            'plat_nomor_2' => 'required',
            'plat_nomor_3' => 'required',
            'driver' => 'required',
            'tujuan_rencana' => 'required',
            'tujuan_aktual' => 'required',
            'keperluan' => 'required',
        ];

        $messages = [
            'tanggal_buat.required' => 'Tanggal Buat Wajib Diisi',
            'plat_nomor_1.required' => 'Plat Nomor Huruf Depan Wajib Diisi',
            'plat_nomor_2.required' => 'Plat Nomor Tengah Wajib Diisi',
            'plat_nomor_3.required' => 'Plat Nomor Huruf Terakhir Wajib Diisi',
            'driver.required' => 'Driver Wajib Diisi',
            'tujuan_rencana.required' => 'Tujuan Rencana Wajib Diisi',
            'tujuan_aktual.required' => 'Tujuan Aktual Wajib Diisi',
            'keperluan.required' => 'Keperluan Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $data_car_travel_order = $this->car_travel_order->find($id);
            $input['tanggal_buat'] = $request->tanggal_buat;
            $input['no_polisi'] = strtoupper($request->plat_nomor_1).'-'.$request->plat_nomor_2.'-'.strtoupper($request->plat_nomor_3);
            $input['driver_id'] = $request->driver;
            $input['tujuan_rencana'] = $request->tujuan_rencana;
            $input['tujuan_aktual'] = $request->tujuan_aktual;
            $input['keperluan'] = $request->keperluan;
            if ($request->perubahan_penumpang == 'Y') {
                $input['penumpang'] = json_encode($request->penumpang);
            }
            $input['ttd_pemakai'] = auth()->user()->nik.'_'.auth()->user()->name.'_'.auth()->user()->departemen.'_'.$data_car_travel_order->id;

            $data_car_travel_order->update($input);
            if ($data_car_travel_order) {
                $message_title="Berhasil !";
                $message_content="Formulir CTO Nomor ID ".$data_car_travel_order->id." Berhasil Diupdate.";
                $message_type="success";
                $message_succes = true;
            }
            $array_message = array(
                'success' => $message_succes,
                'message_title' => $message_title,
                'message_content' => $message_content,
                'message_type' => $message_type,
            );
            return response()->json($array_message);
        }
        return response()->json(
            [
                'success' => false,
                'error' => $validator->errors()->all()
            ]
        );
    }

    public function validasi($id)
    {
        $data['cto'] = $this->car_travel_order->find($id);
        if (empty($data['cto'])) {
            return redirect()->back()->with('error','Data Tidak Ditemukan');
        }

        return view('backend.cto.validasi',$data);
    }

    public function validasi_simpan(Request $request,$id)
    {
        $data_car_travel_order = $this->car_travel_order->find($id);
        if ($request->verifikasi_hrd == 'Y') {
            $input['ttd_umum'] = auth()->user()->nik.'_'.auth()->user()->name.'_'.auth()->user()->departemen.'_'.$data_car_travel_order->id.'_Setuju';
        }elseif ($request->verifikasi_hrd == 'T') {
            $input['ttd_umum'] = auth()->user()->nik.'_'.auth()->user()->name.'_'.auth()->user()->departemen.'_'.$data_car_travel_order->id.'_Tolak';
            $input['status'] = 'Rejected';
        }

        if ($request->security_jam_keluar && $request->security_km_keluar) {
            $input['security_ttd_keluar'] = auth()->user()->nik.'_'.auth()->user()->name.'_'.auth()->user()->departemen.'_'.$data_car_travel_order->id.'_Setuju';
            $input['security_jam_keluar'] = $request->security_jam_keluar;
            $input['security_km_keluar'] = $request->security_km_keluar;
            $input['status'] = 'On Going';
        }

        if ($request->security_jam_masuk && $request->security_km_masuk) {
            $input['security_ttd_masuk'] = auth()->user()->nik.'_'.auth()->user()->name.'_'.auth()->user()->departemen.'_'.$data_car_travel_order->id.'_Setuju';
            $input['security_jam_masuk'] = $request->security_jam_masuk;
            $input['security_km_masuk'] = $request->security_km_masuk;
            $input['status'] = 'Verified';
        }

        $data_car_travel_order->update($input);
        if ($data_car_travel_order) {
            $message_title="Berhasil !";
            $message_content="Formulir CTO Nomor ID ".$data_car_travel_order->id." Berhasil Divalidasi.";
            $message_type="success";
            $message_succes = true;
        }
        $array_message = array(
            'success' => $message_succes,
            'message_title' => $message_title,
            'message_content' => $message_content,
            'message_type' => $message_type,
        );
        return response()->json($array_message);

        // if ($request->security_ttd_keluar == 'Y') {
        //     $input['security_ttd_keluar'] = auth()->user()->nik.'_'.auth()->user()->name.'_'.auth()->user()->departemen.'_'.$data_car_travel_order->id.'_Setuju';
        //     $input['security_jam_keluar'] = $request->security_jam_keluar;
        //     $input['security_km_keluar'] = $request->security_km_keluar;
        //     $input['status'] = 'On Going';
        // }elseif($request->security_ttd_keluar == 'T') {
        //     $input['security_ttd_keluar'] = auth()->user()->nik.'_'.auth()->user()->name.'_'.auth()->user()->departemen.'_'.$data_car_travel_order->id.'_Tolak';
        //     $input['status'] = 'Rejected';
        // }

        // if ($request->security_ttd_masuk == 'Y') {
        //     $input['security_ttd_keluar'] = auth()->user()->nik.'_'.auth()->user()->name.'_'.auth()->user()->departemen.'_'.$data_car_travel_order->id.'_Setuju';
        //     $input['security_jam_masuk'] = $request->security_jam_masuk;
        //     $input['security_km_masuk'] = $request->security_km_masuk;
        //     $input['status'] = 'Verifikasi Selesai';
        // }elseif($request->security_ttd_masuk == 'T') {
        //     $input['security_ttd_keluar'] = auth()->user()->nik.'_'.auth()->user()->name.'_'.auth()->user()->departemen.'_'.$data_car_travel_order->id.'_Tolak';
        //     $input['status'] = 'Rejected';
        // }
    }
}
