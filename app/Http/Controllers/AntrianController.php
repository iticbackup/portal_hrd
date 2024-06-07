<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Antrian;
use App\Models\BiodataKaryawan;
use \Carbon\Carbon;

use App\Mail\AntrianNotifikasiMail;
use App\Mail\AntrianPanggilanMail;
use App\Mail\AntrianStatusMail;

use DB;
use Validator;
use DataTables;
use Mail;

class AntrianController extends Controller
{
    function __construct(
        Antrian $antrian,
        BiodataKaryawan $biodata_karyawan
    )
    {
        $this->antrian = $antrian;
        $this->biodata_karyawan = $biodata_karyawan;
        $this->addDay = 0;
    }

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
        return view('frontend.index',$data);
    }

    public function formulir_antrian()
    {
        return view('frontend.formulir_antrian');
    }

    public function search_nik(Request $request)
    {
        $search_nik = $this->biodata_karyawan->where('nik',$request->nik)->first();
        if (empty($search_nik)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'NIK tidak ditemukan'
            ]);
        }
        return response()->json([
            'success' => true,
            'message_title' => 'Success',
            'data' => [
                'nik' => $search_nik->nik,
                'nama' => $search_nik->nama,
                'satuan_kerja' => $search_nik->satuan_kerja,
                'departemen' => $search_nik->departemen->nama_departemen,
                'bagian' => $search_nik->posisi->nama_posisi,
            ]
        ]);
    }

    public function simpan(Request $request)
    {
        $rules = [
            'nik' => 'required',
            'email' => 'required',
            'dept_tujuan' => 'required',
            'keperluan' => 'required',
        ];

        $messages = [
            'nik.required'  => 'NIK wajib diisi.',
            'email.required'  => 'Email wajib diisi.',
            'dept_tujuan.required'  => 'Departemen Tujuan wajib diisi.',
            'keperluan.required'  => 'Keperluan User wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $input['id'] = Str::uuid()->toString();
            $input['nik'] = $request->nik;
            $input['name'] = $request->name;
            $input['email'] = $request->email;
            $input['departemen'] = $request->departemen;
            $input['bagian'] = $request->bagian;
            $input['dept_tujuan'] = $request->dept_tujuan;
            $input['keperluan'] = $request->keperluan;

            $live_date = Carbon::now()->addDay($this->addDay);
            $start_time = Carbon::createFromTimeString('08:00')->addDay($this->addDay);
            $end_time = Carbon::createFromTimeString('15:30')->addDay($this->addDay);

            // dd($end_time);
            
            if ($live_date->between($start_time,$end_time)) {
                $check_nik = $this->antrian->where('nik',$request->nik)
                                            // ->where('no_urut',$no_urut)
                                            ->where('tgl_input','like','%'.$live_date->format('Y-m-d').'%')
                                            ->orderBy('created_at','desc')
                                            ->first();
                                            // dd($check_nik);
                if (empty($check_nik)) {
                    $no_urut = $this->antrian->where('tgl_input','like','%'.$live_date->format('Y-m-d').'%')
                                            ->orderBy('created_at','desc')
                                            ->max('no_urut');
                    if (empty($no_urut)) {
                        $input['no_urut'] = 1;
                    }else{
                        $input['no_urut'] = $no_urut+1;
                    }
                    $input['tgl_input'] = $live_date;
                    $input['status'] = 'Waiting';
                    $save_antrian = $this->antrian->create($input);
                    if ($save_antrian) {
                        Mail::to($input['email'])
                            ->send(new AntrianNotifikasiMail(
                                'Konfirmasi Nomor Antrian',
                                $input['no_urut'],
                                $input['nik'],
                                $input['name'],
                                $input['email'],
                                $input['departemen'],
                                $input['bagian'],
                                $input['dept_tujuan'],
                                $input['keperluan']
                            ));
                        $message_title="Berhasil !";
                        $message_content="Antrian Anda Berhasil Dibuat, Silahkan cek notifikasi Email Anda secara berkala";
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
                }else{
                    return response()->json([
                        'success' => false,
                        'message_title' => 'Gagal',
                        'message_content' => 'Anda dalam Nomor Antrian '.$check_nik->no_urut
                    ]);
                }
            }else{
                return response()->json([
                    'success' => false,
                    'message_title' => 'Overtime',
                    'message_content' => 'Waktu antrian sudah melebihi batas, Silahkan input lagi dihari berikutnya'
                ]);
            }
            // if ($live_date->format('H:i') >= "15:30") {
            //     return response()->json([
            //         'success' => false,
            //         'message_title' => 'Overtime',
            //         'message_content' => 'Waktu antrian sudah melebihi batas'
            //     ]);
            // }else{
            //     $no_urut = $this->antrian->max('no_urut');
            //     if (empty($no_urut)) {
            //         $input['no_urut'] = '01';
            //     }else{
            //         $start_time = Carbon::createFromTimeString('08:00');
            //         $end = Carbon::createFromTimeString('15:30');
            //         if
            //     }
            // }
            
        }

        return response()->json(
            [
                'success' => false,
                'error' => $validator->errors()->all()
            ]
        );
    }

    public function b_index(Request $request)
    {
        if ($request->ajax()) {
            $live_date = Carbon::now()->addDay($this->addDay);
            if (auth()->user()->departemen == null) {
                $data = $this->antrian->where('tgl_input','like','%'.$live_date->format('Y-m-d').'%')
                                    ->get();
            }else{
                $data = $this->antrian->where('tgl_input','like','%'.$live_date->format('Y-m-d').'%')
                                    ->where('dept_tujuan',auth()->user()->departemen)
                                    ->get();
            }
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('no_urut', function($row){
                                if ($row->no_urut <= 9) {
                                    return '0'.$row->no_urut;
                                }else{
                                    return $row->no_urut;
                                }
                            })
                            ->addColumn('status', function($row){
                                switch ($row->status) {
                                    case 'Waiting':
                                        return '<span class="badge badge-warning mb-2 me-4">Sedang Menunggu</span>';
                                        break;
                                    case 'Terpanggil':
                                        return '<span class="badge badge-warning mb-2 me-4">Terpanggil</span>';
                                        break;
                                    case 'Proses':
                                        return '<span class="badge badge-info mb-2 me-4">Proses</span>';
                                        break;
                                    case 'Selesai':
                                        return '<span class="badge badge-success mb-2 me-4">Selesai</span>';
                                        break;
                                    case 'Tolak':
                                        return '<span class="badge badge-danger mb-2 me-4">Tolak</span>';
                                        break;
                                    case 'Cancel':
                                        return '<span class="badge badge-danger mb-2 me-4">Cancel</span>';
                                        break;
                                    default:
                                        # code...
                                        break;
                                }
                            })
                            ->addColumn('panggil', function($row){
                                $btn = "<div>";
                                $btn = $btn."<button type='button' class='btn btn-secondary mb-2 me-2' onclick='panggilan(`".$row->id."`)'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'>
                                                <path fill='currentColor' d='M12 12V7.65c0-.11.025-.22.072-.316c.152-.314.5-.428.775-.253l6.86 4.349c.093.059.17.147.221.253c.153.314.054.71-.221.885l-6.86 4.35a.516.516 0 0 1-.277.081c-.315 0-.57-.291-.57-.651zc0 .23-.106.451-.293.57l-6.86 4.35a.516.516 0 0 1-.277.08c-.315 0-.57-.291-.57-.651V7.651c0-.11.025-.22.072-.316c.152-.314.5-.428.775-.253l6.86 4.349c.093.059.17.147.221.253c.049.1.072.209.072.315' />
                                            </svg></button>";
                                $btn = $btn."</div>";
                                return $btn;
                            })
                            ->addColumn('action', function($row){
                                $btn = "<div>";
                                // $btn = $btn."<a href=".route('roles.edit',['id' => $row->id])." type='button' class='btn btn-warning mb-2 me-2'>
                                //             <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 28 28'>
                                //                 <path fill='currentColor' fill-rule='evenodd' d='M5 20h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m-1-5L14 5l3 3L7 18H4zM15 4l2-2l3 3l-2.001 2.001z' />
                                //             </svg> Edit
                                //             </a>";
                                // $btn = $btn."<form action=".route('roles.destroy',['id' => $row->id])." method='GET'>";
                                // $btn = $btn."<button type='submit' class='btn btn-danger mb-2 me-2'>
                                //             <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 28 28'>
                                //                 <path fill='currentColor' d='M4 5h3V4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1h3a1 1 0 0 1 0 2h-1v13a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7H4a1 1 0 1 1 0-2m3 2v13h10V7zm2-2h6V4H9zm0 4h2v9H9zm4 0h2v9h-2z' />
                                //             </svg> Delete</button>";
                                // $btn = $btn."<form>";
                                $btn = $btn."<button type='button' class='btn btn-info mb-2 me-2' onclick='resend_mail(`".$row->id."`)'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'>
                                                <path fill='currentColor' d='m13.761 12.01l-10.76-1.084L3 4.074a1.074 1.074 0 0 1 1.554-.96l15.852 7.926a1.074 1.074 0 0 1 0 1.92l-15.85 7.926a1.074 1.074 0 0 1-1.554-.96v-6.852z' />
                                            </svg> Resending Email</button>";
                                $btn = $btn."<button type='button' class='btn btn-primary mb-2 me-2' onclick='detail(`".$row->id."`)'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'>
                                                <path fill='currentColor' fill-rule='evenodd' d='M2 12c.945-4.564 5.063-8 10-8s9.055 3.436 10 8c-.945 4.564-5.063 8-10 8s-9.055-3.436-10-8m10 5a5 5 0 1 0 0-10a5 5 0 0 0 0 10m0-2a3 3 0 1 0 0-6a3 3 0 0 0 0 6' />
                                            </svg> Detail</button>";
                                $btn = $btn."</div>";

                                return $btn;
                            })
                            ->rawColumns(['status','panggil','action'])
                            ->make(true);
        }
        return view('backend.antrian.index');
    }
    
    public function b_detail($id)
    {
        $detail_antrian = $this->antrian->find($id);
        if (empty($detail_antrian)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Antrian tidak ditemukan'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $detail_antrian
        ]);
    }

    public function b_resend_mail($id)
    {
        $detail_antrian = $this->antrian->find($id);
        if (empty($detail_antrian)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Antrian tidak ditemukan'
            ]);
        }
        Mail::to($detail_antrian->email)
                ->send(new AntrianNotifikasiMail(
                    'Konfirmasi Antrian',
                    $detail_antrian->no_urut,
                    $detail_antrian->nik,
                    $detail_antrian->name,
                    $detail_antrian->email,
                    $detail_antrian->departemen,
                    $detail_antrian->bagian,
                    $detail_antrian->dept_tujuan,
                    $detail_antrian->keperluan
                ));
        return response()->json([
            'success' => true,
        ]);
    }

    public function b_panggilan($id)
    {
        $detail_antrian = $this->antrian->find($id);
        if (empty($detail_antrian)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Antrian tidak ditemukan'
            ]);
        }
        
        $live_date = Carbon::now()->addDay($this->addDay);
        $sisa_antrian_hari_ini = $this->antrian->where('tgl_input','like','%'.$live_date->format('Y-m-d').'%')
                                                ->whereIn('status',['Waiting'])
                                                ->count();
        // dd($total_antrian_hari_ini);

        $detail_antrian->update([
            'status' => 'Terpanggil'
        ]);

        Mail::to($detail_antrian->email)
            ->send(new AntrianPanggilanMail(
                'Konfirmasi Antrian',
                $detail_antrian->no_urut,
                $detail_antrian->nik,
                $detail_antrian->name,
                $detail_antrian->email,
                $detail_antrian->departemen,
                $detail_antrian->bagian,
                $detail_antrian->dept_tujuan,
                $detail_antrian->keperluan
            ));

        event(new \App\Events\FrontendNotification(
            $detail_antrian->no_urut,
            $sisa_antrian_hari_ini
        ));

        return response()->json([
            'success' => true,
        ]);
    }

    public function b_detail_update(Request $request)
    {
        $detail_antrian = $this->antrian->find($request->detail_id);
        if (empty($detail_antrian)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Antrian tidak ditemukan'
            ]);
        }

        $detail_antrian->update([
            'status' => $request->detail_status
        ]);

        Mail::to($detail_antrian->email)
                ->send(new AntrianStatusMail(
                    'Status Antrian',
                    $detail_antrian->name,
                    $detail_antrian->dept_tujuan,
                    $request->detail_status,
                ));

        return response()->json([
            'success' => true,
            'message_title' => 'Success',
            'message_content' => 'Status Antrian '.$detail_antrian->name.' Berhasil diupdate'
        ]);
    }

}
