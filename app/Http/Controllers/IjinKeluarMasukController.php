<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\IjinKeluarMasuk;
use App\Models\IjinKeluarMasukTTD;
use App\Models\BiodataKaryawan;
use \Carbon\Carbon;

use Auth;
use DB;
use PDF;
use Validator;
use DataTables;

class IjinKeluarMasukController extends Controller
{
    function __construct(
        IjinKeluarMasuk $ijin_keluar_masuk,
        IjinKeluarMasukTTD $ijin_keluar_masuk_ttd,
        BiodataKaryawan $biodata_karyawan
    ){
        $this->ijin_keluar_masuk = $ijin_keluar_masuk;
        $this->ijin_keluar_masuk_ttd = $ijin_keluar_masuk_ttd;
        $this->biodata_karyawan = $biodata_karyawan;
        $this->addDay = 0;
    }

    public function f_index()
    {
        $data['biodata_karyawans'] = $this->biodata_karyawan->whereNotIn('nik',['1000001','1000002','1000003'])
                                                            ->where('status_karyawan','!=','R')
                                                            // ->orwhere('status_karyawan',null)
                                                            ->where('id_jabatan','<=','10')
                                                            ->get();

        return view('frontend.ijin_keluar_masuk.form',$data);
    }

    public function f_simpan(Request $request)
    {
        $rules = [
            'nik' => 'required',
            'email' => 'required',
            'kendaraan' => 'required',
            'kategori_keperluan' => 'required',
            'keperluan' => 'required',
            'jam_kerja' => 'required',
            'jam_rencana_keluar' => 'required',
            // 'jam_datang' => 'required',
        ];

        $messages = [
            'nik.required'  => 'NIK wajib diisi.',
            'email.required'  => 'Email wajib diisi.',
            'kendaraan.required'  => 'Kendaraan wajib diisi.',
            'kategori_keperluan.required'  => 'Kategori Keperluan wajib diisi.',
            'keperluan.required'  => 'Keperluan User wajib diisi.',
            'jam_kerja.required'  => 'Jam Kerja wajib diisi.',
            'jam_rencana_keluar.required'  => 'Jam Rencana Keluar wajib diisi.',
            // 'jam_datang.required'  => 'Jam Datang wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            // if (!Auth::check()) {
            //     return response()->json([
            //         'success' => false,
            //         'message_title' => 'Gagal',
            //         'message_content' => 'Silahkan Login Terlebih Dahulu'
            //     ]);
            // }
            $input['id'] = Str::uuid()->toString();
            $input['nik'] = $request->nik;
            $input['nama'] = $request->nama;
            $input['email'] = $request->email;
            $input['jabatan'] = $request->jabatan;
            $input['unit_kerja'] = $request->departemen;
            $input['kategori_keperluan'] = $request->kategori_keperluan;
            $input['keperluan'] = $request->keperluan;
            $input['kendaraan'] = $request->kendaraan;
            $input['jam_kerja'] = $request->jam_kerja;
            $input['jam_rencana_keluar'] = $request->jam_rencana_keluar;
            // $input['jam_datang'] = $request->jam_datang;

            // $live_date = Carbon::now()->addDay($this->addDay);
            // $start_time = Carbon::createFromTimeString('08:00')->addDay($this->addDay);
            // $end_time = Carbon::createFromTimeString('15:30')->addDay($this->addDay);

            // if ($live_date->between($start_time,$end_time)) {
            //     // $check_nik = $this->ijin_keluar_masuk->where('nik',$request->nik)
            //     //                                     ->where('created_at','like','%'.$live_date->format('Y-m-d').'%')
            //     //                                     ->orderBy('created_at','desc')
            //     //                                     ->first();
            //     // if (empty($check_nik)) {
            //     //     $no_urut = $this->ijin_keluar_masuk->where('created_at','like','%'.$live_date->format('Y-m-d').'%')
            //     //                                     ->orderBy('created_at','desc')
            //     //                                     ->max('no');
            //     //     if (empty($no_urut)) {
            //     //         $input['no'] = '001';
            //     //     }else{
            //     //         $input['no'] = sprintf("%03s",(int)substr($no_urut, 3, 3));
            //     //     }
            //     //     $input['status'] = 'Waiting';
            //     //     $save_ijin_keluar_masuk = $this->ijin_keluar_masuk->create($input);
            //     //     if ($save_ijin_keluar_masuk) {
            //     //         $this->ijin_keluar_masuk_ttd->create([
            //     //             'id' => Str::uuid()->toString(),
            //     //             'ijin_keluar_masuk_id' => $input['id']
            //     //         ]);
            //     //         $message_title="Berhasil !";
            //     //         $message_content="Formulir Ijin Keluar Masuk Berhasil Dibuat, Silahkan cek notifikasi Email Anda secara berkala.";
            //     //         $message_type="success";
            //     //         $message_succes = true;
            //     //     }
            //     //     $array_message = array(
            //     //         'success' => $message_succes,
            //     //         'message_title' => $message_title,
            //     //         'message_content' => $message_content,
            //     //         'message_type' => $message_type,
            //     //     );
            //     //     return response()->json($array_message);
            //     // }else{
            //     //     return response()->json([
            //     //         'success' => false,
            //     //         'message_title' => 'Gagal',
            //     //         'message_content' => 'Anda dalam Nomor Formulir Ijin Keluar Masuk '.$check_nik->no.'-'.$check_nik->created_at->format('Ymd')
            //     //     ]);
            //     // }
            //     $no_urut = $this->ijin_keluar_masuk->where('created_at','like','%'.$live_date->format('Y-m-d').'%')
            //                                         ->orderBy('created_at','desc')
            //                                         ->max('no');
            //     if (empty($no_urut)) {
            //         $input['no'] = '001';
            //     }else{
            //         $input['no'] = sprintf("%03s",(int)substr($no_urut, 3, 3));
            //     }
            //     $input['status'] = 'Waiting';
            //     $save_ijin_keluar_masuk = $this->ijin_keluar_masuk->create($input);
            //     if ($save_ijin_keluar_masuk) {
            //         $this->ijin_keluar_masuk_ttd->create([
            //             'id' => Str::uuid()->toString(),
            //             'ijin_keluar_masuk_id' => $input['id']
            //         ]);
            //         $message_title="Berhasil !";
            //         $message_content="Formulir Ijin Keluar Masuk Berhasil Dibuat, Silahkan cek notifikasi Email Anda secara berkala.";
            //         $message_type="success";
            //         $message_succes = true;
            //     }
            //     $array_message = array(
            //         'success' => $message_succes,
            //         'message_title' => $message_title,
            //         'message_content' => $message_content,
            //         'message_type' => $message_type,
            //     );
            //     return response()->json($array_message);
            // }else{
            //     return response()->json([
            //         'success' => false,
            //         'message_title' => 'Overtime',
            //         'message_content' => 'Waktu pengisian Formulir Ijin Keluar Masuk sudah melebihi batas, Silahkan input lagi dihari berikutnya'
            //     ]);
            // }
            $live_date = Carbon::now()->addDay($this->addDay);
            $no_urut = $this->ijin_keluar_masuk->where('created_at','like','%'.$live_date->format('Y-m').'%')
                                                    ->orderBy('created_at','desc')
                                                    ->max('no');
            // dd($no_urut);
            // $no_urut = $this->ijin_keluar_masuk->where('created_at','like','%'.$live_date->format('Y-m-d').'%')
            //                                         ->orderBy('created_at','desc')
            //                                         ->max('no');
            if (!$no_urut) {
                $input['no'] = sprintf("%03s",(int)substr('001', 0, 3));
            }else{
                $input['no'] = sprintf("%03s",(int)substr($no_urut+1, 0, 3));
            }
            // dd($input['no']);
            $input['status'] = 'Waiting';
            $save_ijin_keluar_masuk = $this->ijin_keluar_masuk->create($input);
            if ($save_ijin_keluar_masuk) {
                $this->ijin_keluar_masuk_ttd->create([
                    'id' => Str::uuid()->toString(),
                    'ijin_keluar_masuk_id' => $input['id'],
                    'signature_manager' => $request->mengetahui_manager_bagian.'|Waiting'
                ]);
                $message_title="Berhasil !";
                $message_content="Formulir Ijin Keluar Masuk Berhasil Dibuat, Silahkan cek notifikasi Email Anda secara berkala.";
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
                'message_content' => $validator->errors()->all()
            ]
        );
    }

    public function b_index(Request $request)
    {
        if ($request->ajax()) {
            if (auth()->user()->departemen == 'Administrator' || auth()->user()->departemen == 'HRD' || auth()->user()->departemen == 'Satpam') {
                $data = $this->ijin_keluar_masuk->all();
            }else{
                $data = $this->ijin_keluar_masuk->whereHas('ijin_keluar_masuk_ttd', function($ikmt){
                                                    $ikmt->where('signature_manager','like','%'.auth()->user()->nik.'%');
                                                })
                                                ->orwhere('nik',auth()->user()->nik)
                                                ->get();
            }
            return DataTables::of($data)
                                    ->addIndexColumn()
                                    ->addColumn('no', function($row){
                                        return '<span class="badge badge-primary">'.$row->no.'-'.$row->created_at->format('Ymd').'</span>';
                                    })
                                    ->addColumn('status', function($row){
                                        switch ($row->status) {
                                            case 'Waiting':
                                                return '<span class="badge badge-warning mb-2 me-4">Menunggu Verifikasi</span>';
                                                break;
                                            case 'Approved':
                                                if ($row->jam_datang) {
                                                    return '<span class="badge badge-success mb-2 me-4">Approved</span>';
                                                }else{
                                                    return '<span class="badge badge-success mb-2 me-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20">
                                                                <path fill="currentColor" fill-rule="evenodd" d="m6 10l-2 2l6 6L20 8l-2-2l-8 8z" />
                                                            </svg>
                                                            Approved
                                                            </span>'.
                                                            '<span class="badge badge-warning mb-2 me-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20">
                                                                <path fill="currentColor" d="m13.761 12.01l-10.76-1.084L3 4.074a1.074 1.074 0 0 1 1.554-.96l15.852 7.926a1.074 1.074 0 0 1 0 1.92l-15.85 7.926a1.074 1.074 0 0 1-1.554-.96v-6.852z" />
                                                            </svg>
                                                            On Going
                                                            </span>';
                                                }
                                                break;
                                            case 'Rejected':
                                                return '<span class="badge badge-danger mb-2 me-4">'.'<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                <circle cx="12" cy="12" r="10" />
                                                                <path d="m15 9l-6 6m0-6l6 6" />
                                                            </g>
                                                        </svg>'.
                                                        'Rejected</span>';
                                                break;
                                            default:
                                                # code...
                                                break;
                                        }
                                    })
                                    ->addColumn('action', function($row){
                                        $btn = "<div>";
                                        // $btn = $btn."<button type='button' class='btn btn-info mb-2 me-2' onclick='resend_mail(`".$row->id."`)'>
                                        //                 <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'>
                                        //                 <path fill='currentColor' d='m13.761 12.01l-10.76-1.084L3 4.074a1.074 1.074 0 0 1 1.554-.96l15.852 7.926a1.074 1.074 0 0 1 0 1.92l-15.85 7.926a1.074 1.074 0 0 1-1.554-.96v-6.852z' />
                                        //             </svg> Resending Email</button>";
                                        $btn = $btn."<a class='btn btn-primary mb-2 me-2' href=".route('b_ijin_keluar_masuk.detail',['id' => $row->id]).">
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'>
                                                        <path fill='currentColor' fill-rule='evenodd' d='M2 12c.945-4.564 5.063-8 10-8s9.055 3.436 10 8c-.945 4.564-5.063 8-10 8s-9.055-3.436-10-8m10 5a5 5 0 1 0 0-10a5 5 0 0 0 0 10m0-2a3 3 0 1 0 0-6a3 3 0 0 0 0 6' />
                                                    </svg> Detail</a>";
                                        if ($row->status == 'Approved') {
                                            if ($row->jam_datang == null) {
                                                $btn = $btn."<button class='btn btn-info mb-2 me-2' onclick='input_jam_datang(`".$row->id."`)'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'>
                                                                    <path fill='currentColor' fill-rule='evenodd' d='M5 20h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m-1-5L14 5l3 3L7 18H4zM15 4l2-2l3 3l-2.001 2.001z' />
                                                                </svg> Input Jam Datang</button>";
                                            }
                                            $btn = $btn."<a class='btn btn-dark mb-2 me-2' href=".route('b_ijin_keluar_masuk.cetak_surat',['id' => $row->id])." target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'>
                                                            <g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'>
                                                                <path d='M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2' />
                                                                <path d='M6 14h12v8H6z' />
                                                            </g>
                                                        </svg>
                                                    </svg> Cetak Surat</a>";
                                        }
                                        $btn = $btn."</div>";
    
                                        return $btn;
                                    })
                                    ->rawColumns(['no','status','action'])
                                    ->make(true);
        }

        return view('backend.ijin_keluar_masuk.index');
    }

    public function b_detail($id)
    {
        $data['ijin_keluar_masuk'] = $this->ijin_keluar_masuk->find($id);
        if (empty($data['ijin_keluar_masuk'])) {
            return redirect()->back()->with('error','Ijin Keluar Masuk Tidak Ditemukan');
        }

        // if (empty($data['ijin_keluar_masuk']->ijin_keluar_masuk_ttd->signature_manager)) {
        //     $data['explode_validasi_manager_bagian'] = null;
        //     $data['explode_validasi_manager_bagian_tgl_signature'] = null;
        // }else{
        //     $explode_validasi_manager_bagian = explode('|',$data['ijin_keluar_masuk']->ijin_keluar_masuk_ttd->signature_manager);
        //     $data['explode_validasi_manager_bagian'] = $explode_validasi_manager_bagian[0].' ('.$explode_validasi_manager_bagian[1].') '.$explode_validasi_manager_bagian[2];
        //     $data['explode_validasi_manager_bagian_tgl_signature'] = $data['ijin_keluar_masuk']->ijin_keluar_masuk_ttd->tgl_signature_manager;
        // }
        // dd($data);
        return view('backend.ijin_keluar_masuk.detail',$data);
    }

    public function b_input_jam_datang($id)
    {
        $data = $this->ijin_keluar_masuk->find($id);
        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Data tidak ditemukan'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function b_input_jam_datang_update(Request $request)
    {
        $data = $this->ijin_keluar_masuk->find($request->detail_jam_datang_id);
        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Data tidak ditemukan'
            ]);
        }
        $data->update([
            'jam_datang' => $request->detail_jam_datang
        ]);

        if ($data) {
            return response()->json([
                'succcess' => true,
                'message_title' => 'Berhasil',
                'message_content' => 'Jam Datang Berhasil Disimpan'
            ]);
        }
        return response()->json([
            'success' => false,
            'error' => 'Server Error'
        ]);
    }

    public function b_validasi($id)
    {
        $data['ijin_keluar_masuk'] = $this->ijin_keluar_masuk->find($id);
        if (empty($data['ijin_keluar_masuk'])) {
            return redirect()->back()->with('error','Ijin Keluar Masuk Tidak Ditemukan');
        }
        return view('backend.ijin_keluar_masuk.validasi',$data);
    }

    public function b_validasi_simpan(Request $request,$id)
    {
        $data_ijin_keluar_masuk = $this->ijin_keluar_masuk::find($id);
        if (empty($data_ijin_keluar_masuk)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Data Ijin Keluar Masuk Tidak Ditemukan'
            ]);
        }

        if ($request->status_validasi_manager) {
            if (!empty($data_ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager)) {
                $explode_validasi_manager_bagian = explode('|',$data_ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager);
                $input['signature_manager'] = $explode_validasi_manager_bagian[0].'|'.$explode_validasi_manager_bagian[1].'|'.$request->status_validasi_manager;
                $input['tgl_signature_manager'] = Carbon::now();
                // $data_ijin_keluar_masuk->update([
                //     'status' => 'Manager '.$request->status_validasi_manager
                // ]);
            }
        }

        if ($request->status_validasi_personalia) {
            if (empty($data_ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia)) {
                $input['signature_personalia'] = auth()->user()->name.'|'.auth()->user()->nik.'|'.$request->status_validasi_personalia;
                $input['tgl_signature_personalia'] = Carbon::now();
                // $data_ijin_keluar_masuk->update([
                //     'status' => 'HRD '.$request->status_validasi_personalia
                // ]);
            }
        }

        if ($request->status_validasi_kend_satpam) {
            if (empty($data_ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam)) {
                $input['signature_kend_satpam'] = auth()->user()->name.'|'.auth()->user()->nik.'|'.$request->status_validasi_kend_satpam;
                $input['tgl_signature_kend_satpam'] = Carbon::now();
                // $data_ijin_keluar_masuk->update([
                //     'status' => 'Satpam '.$request->status_validasi_kend_satpam
                // ]);
            }
        }

        // dd($request->all());
        $update_ttd = $data_ijin_keluar_masuk->ijin_keluar_masuk_ttd->update($input);
        if ($update_ttd) {
            if (!empty($data_ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager)) {
                $explode_status_validasi_manager_bagian = explode('|',$data_ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager);
                $status_manager = $explode_status_validasi_manager_bagian[2];
            }else{
                $status_manager = 'Waiting';
            }

            if (!empty($data_ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia)) {
                $explode_status_validasi_personalia = explode('|',$data_ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia);
                $status_personalia = $explode_status_validasi_personalia[2];
            }else{
                $status_personalia = 'Waiting';
            }

            if (!empty($data_ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam)) {
                $explode_status_validasi_kend_satpam = explode('|',$data_ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam);
                $status_satpam = $explode_status_validasi_kend_satpam[2];
            }else{
                $status_satpam = 'Waiting';
            }

            if ($status_manager == 'Approved' && $status_personalia == 'Approved' && $status_satpam == 'Approved') {
                $data_ijin_keluar_masuk->update([
                    'status' => 'Approved'
                ]);
            }elseif ($status_manager == 'Approved' && $status_personalia == 'Approved' && $status_satpam == 'Rejected') {
                $data_ijin_keluar_masuk->update([
                    'status' => 'Rejected'
                ]);
            }elseif ($status_manager == 'Approved' && $status_personalia == 'Rejected') {
                $data_ijin_keluar_masuk->update([
                    'status' => 'Rejected'
                ]);
            }elseif ($status_manager == 'Rejected') {
                $data_ijin_keluar_masuk->update([
                    'status' => 'Rejected'
                ]);
            }

            $message_title="Berhasil !";
            $message_content="Verifikasi Ijin Keluar Masuk Berhasil Dibuat";
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

    public function cetak_surat($id)
    {
        $data['ijin_keluar_masuk'] = $this->ijin_keluar_masuk->find($id);
        
        if (empty($data['ijin_keluar_masuk'])) {
            return redirect()->back()->with('error','Ijin Keluar Masuk Tidak Ditemukan');
        }
        
        $customPaper = array(0,0,812.5,415.7);
        $pdf = PDF::loadView('backend.ijin_keluar_masuk.cetak_surat',$data);
        $pdf->setPaper($customPaper);
        return $pdf->stream($data['ijin_keluar_masuk']->nama.' ('.$data['ijin_keluar_masuk']->nik.')'.' '.$data['ijin_keluar_masuk']->no.'-'.$data['ijin_keluar_masuk']->created_at->format('Ymd').'.pdf');
    }
}
