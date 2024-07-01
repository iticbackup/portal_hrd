<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\IjinAbsen;
use App\Models\IjinAbsenTTD;
use App\Models\IjinAbsenAttachment;
use App\Models\BiodataKaryawan;
use \Carbon\Carbon;

use App\Mail\IjinAbsenNotif;

use Auth;
use DB;
use PDF;
use Validator;
use DataTables;
use Mail;
use File;

class IjinAbsenController extends Controller
{
    function __construct(
        IjinAbsen $ijin_absen,
        IjinAbsenTTD $ijin_absen_ttd,
        IjinAbsenAttachment $ijin_absen_attachment,
        BiodataKaryawan $biodata_karyawan
    ){
        $this->ijin_absen = $ijin_absen;
        $this->ijin_absen_ttd = $ijin_absen_ttd;
        $this->ijin_absen_attachment = $ijin_absen_attachment;
        $this->biodata_karyawan = $biodata_karyawan;
        $this->addDay = 0;

        $this->middleware('permission:ijinabsen-list', ['only' => ['f_index','b_detail']]);
        $this->middleware('permission:ijinabsen-verifikasi', ['only' => ['b_validasi','b_validasi_simpan']]);
        $this->middleware('permission:ijinabsen-store', ['only' => ['f_simpan']]);
        // $this->middleware('permission:ijinabsen-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:ijinabsen-delete', ['only' => ['delete']]);
    }

    public function f_index()
    {
        $data['biodata_karyawans'] = $this->biodata_karyawan->whereNotIn('nik',['1000001','1000002','1000003'])
                                                            ->where('status_karyawan','!=','R')
                                                            // ->orwhere('status_karyawan',null)
                                                            ->where('id_jabatan','<=','10')
                                                            ->get();
        $data['saksis'] = $this->biodata_karyawan->whereNotIn('nik',['1000001','1000002','1000003'])
                                                            ->where('status_karyawan','!=','R')
                                                            // ->orwhere('status_karyawan',null)
                                                            // ->where('id_jabatan','<=','10')
                                                            ->get();
        return view('frontend.ijin_absen.form',$data);
    }

    public function f_simpan(Request $request)
    {
        $rules = [
            'nik' => 'required',
            'email' => 'required',
            'hari' => 'required',
            'tgl_mulai' => 'required',
            'tgl_berakhir' => 'required',
            'kategori_izin' => 'required',
            'selama' => 'required',
            'keperluan' => 'required',
            'saksi_1' => 'required',
            'saksi_2' => 'required',
            'mengetahui_manager_bagian' => 'required',
        ];

        $messages = [
            'nik.required'  => 'NIK wajib diisi.',
            'email.required'  => 'Email wajib diisi.',
            'hari.required'  => 'Hari wajib diisi.',
            'tgl_mulai.required'  => 'Mulai Tanggal wajib diisi.',
            'tgl_berakhir.required'  => 'Sampai Tanggal wajib diisi.',
            'kategori_izin.required'  => 'Kategori Izin wajib diisi.',
            'selama.required'  => 'Input Selama wajib diisi.',
            'keperluan.required'  => 'Keperluan wajib diisi.',
            'saksi_1.required'  => 'Saksi 1 wajib diisi.',
            'saksi_2.required'  => 'Saksi 2 wajib diisi.',
            'mengetahui_manager_bagian.required'  => 'Mengetahui Manager wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $input['id'] = Str::uuid()->toString();
            $input['nik'] = $request->nik;
            $input['nama'] = $request->nama;
            $input['email'] = $request->email;
            $input['jabatan'] = $request->jabatan;
            $input['unit_kerja'] = $request->departemen;
            $input['hari'] = $request->hari;
            $input['tgl_mulai'] = $request->tgl_mulai;
            $input['tgl_berakhir'] = $request->tgl_berakhir;
            $input['kategori_izin'] = $request->kategori_izin;
            $input['selama'] = $request->selama;
            $input['keperluan'] = $request->keperluan;
            $input['saksi_1'] = $request->saksi_1.'|'.$request->saksi1_unit_kerja;
            $input['saksi_2'] = $request->saksi_2.'|'.$request->saksi2_unit_kerja;

            $live_date = Carbon::now()->addDay($this->addDay);
            $no_urut = $this->ijin_absen->where('created_at','like','%'.$live_date->format('Y-m').'%')
                                        ->orderBy('created_at','desc')
                                        ->max('no');
            if (!$no_urut) {
                $input['no'] = sprintf("%03s",(int)substr('001', 0, 3));
            }else{
                $input['no'] = sprintf("%03s",(int)substr($no_urut+1, 0, 3));
            }

            $input['status'] = 'Waiting';

            // dd($request->attachment);

            $save_ijin_absen = $this->ijin_absen->create($input);

            if ($save_ijin_absen) {
                $this->ijin_absen_ttd->create([
                    'id' => Str::uuid()->toString(),
                    'ijin_absen_id' => $input['id'],
                    'signature_bersangkutan' => $request->mengetahui_manager_bagian.'|Waiting',
                    'signature_saksi_1' => $request->saksi_1.'|'.'Waiting',
                    'signature_saksi_2' => $request->saksi_2.'|'.'Waiting',
                ]);

                // if ($request->file('attachment')) {
                //     $attachment = $request->file('attachment');
                //     foreach ($attachment as $atc) {
                //         if ($atc->getClientOriginalExtension() == 'jpg' || $atc->getClientOriginalExtension() == 'jpeg' || $atc->getClientOriginalExtension() == 'png') {
                //             $filename = $request->nik.'-'.$request->nama.'-'.time().'.'.$atc->getClientOriginalExtension();
                //             $atc->move(public_path('ijin_absensi/'),$filename);
    
                //             $imgAttachment = \Image::make(public_path('ijin_absensi/'.$filename));
                //             // $imgAttachment = \Image::make($atc->path());
                //             $imgAttachment = $imgAttachment->encode('webp',75);
                //             $inputAttachment = $request->nik.'-'.$request->nama.'-'.time().'.webp';
                //             $dataAttachment[] = $inputAttachment;
                //             $imgAttachment->save(public_path('ijin_absensi/').$inputAttachment);
                //             File::delete(public_path('ijin_absensi/'.$filename));
                //         }else{
                //             return redirect()->back()->with('error','Attachment tidak sesuai format.');
                //         }
                //         // dd($atc->getClientOriginalExtension());
                //     }

                //     $save_attachment = json_encode($dataAttachment);
                // }else{
                //     $save_attachment = null;
                // }

                if ($request->hasFile('attachment')) {
                    $allowedfileExtension=['jpg','png','jpeg','JPG','PNG','JPEG'];
                    $files = $request->file('attachment');
                    foreach ($files as $file) {
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $check=in_array($extension,$allowedfileExtension);
                        if ($check) {
                            $imgAttachment = \Image::make($file->move(public_path('ijin_absensi/'),$filename));
                            $imgAttachment->encode('webp',75);
                            $inputAttachment = $request->nik.'-'.$request->nama.'-'.rand(100,999).'.webp';
                            $dataAttachment[] = $inputAttachment;
                            $imgAttachment->save(public_path('ijin_absensi/').$inputAttachment);
                            File::delete(public_path('ijin_absensi/'.$filename));
                            // $this->ijin_absen_attachment->create([
                            //     'id' => Str::uuid()->toString(),
                            //     'ijin_absen_id' => $input['id'],
                            //     'attachment' => $inputAttachment
                            // ]);
                        }
                    }
                    $save_attachment = json_encode($dataAttachment);
                    $this->ijin_absen_attachment->create([
                        'id' => Str::uuid()->toString(),
                        'ijin_absen_id' => $input['id'],
                        'attachment' => $save_attachment
                    ]);
                }

                Mail::to($input['email'])
                    ->send(new IjinAbsenNotif(
                        'Konfirmasi Ijin Absen',
                        $input['no'].'-'.$live_date->format('Ymd'),
                        $input['nama'],
                        $input['jabatan'],
                        $input['unit_kerja'],
                        $input['email'],
                        $input['hari'],
                        $input['tgl_mulai'],
                        $input['tgl_berakhir'],
                        $input['selama'],
                        $input['keperluan'],
                        $input['status']
                ));

                $message_title="Berhasil !";
                $message_content="Formulir Ijin Absen Berhasil Dibuat, Silahkan cek notifikasi Email Anda secara berkala.";
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
        // $user = request()->user()->roles;
        // $user = \App\Models\User::with('roles')->where('id',auth()->user()->id)->first();
        // dd($user);
        if ($request->ajax()) {
            // if (auth()->user()->departemen == 'Administrator' || auth()->user()->departemen == 'HRD') {
            if (auth()->user()->getRoleNames()[0] == 'Administrator' || auth()->user()->getRoleNames()[0] == 'HRGA Admin') {
                $data = $this->ijin_absen->all();
            }else{
                $data = $this->ijin_absen->whereHas('ijin_absen_ttd', function($iat){
                                            $iat->where('signature_bersangkutan','like','%'.auth()->user()->nik.'%')
                                                ->orWhere('signature_saksi_1','like','%'.auth()->user()->nik.'%')
                                                ->orWhere('signature_saksi_2','like','%'.auth()->user()->nik.'%');
                                        })
                                        ->orWhere('nik',auth()->user()->nik)
                                        ->get();
            }
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('no', function($row){
                                return '<span class="badge badge-primary">'.$row->no.'-'.$row->created_at->format('Ymd').'</span>';
                            })
                            ->addColumn('nama', function($row){
                                return '<span style="font-weight: bold">'.$row->nama.'</span></br><span style="font-size: 9pt"> Tgl Dibuat : '.$row->created_at.'</span>';
                            })
                            ->addColumn('status', function($row){
                                switch ($row->status) {
                                    case 'Waiting':
                                        return '<span class="badge badge-warning mb-2 me-4">Menunggu Verifikasi</span>';
                                        break;
                                    case 'Approved':
                                        return '<span class="badge badge-success mb-2 me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20">
                                                        <path fill="currentColor" fill-rule="evenodd" d="m6 10l-2 2l6 6L20 8l-2-2l-8 8z" />
                                                    </svg>
                                                    Approved
                                                </span>';
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
                                $btn = $btn."<a class='btn btn-primary mb-2 me-2' href=".route('b_ijin_absen.detail',['id' => $row->id]).">
                                                <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'>
                                                <path fill='currentColor' fill-rule='evenodd' d='M2 12c.945-4.564 5.063-8 10-8s9.055 3.436 10 8c-.945 4.564-5.063 8-10 8s-9.055-3.436-10-8m10 5a5 5 0 1 0 0-10a5 5 0 0 0 0 10m0-2a3 3 0 1 0 0-6a3 3 0 0 0 0 6' />
                                            </svg> Detail</a>";
                                if ($row->status == 'Approved') {
                                    // if ($row->jam_datang == null) {
                                    //     $btn = $btn."<button class='btn btn-info mb-2 me-2' onclick='input_jam_datang(`".$row->id."`)'>
                                    //                     <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'>
                                    //                         <path fill='currentColor' fill-rule='evenodd' d='M5 20h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m-1-5L14 5l3 3L7 18H4zM15 4l2-2l3 3l-2.001 2.001z' />
                                    //                     </svg> Input Jam Datang</button>";
                                    // }
                                    $btn = $btn."<a class='btn btn-dark mb-2 me-2' href=".route('b_ijin_absen.cetak_surat',['id' => $row->id])." target='_blank'>
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
                            ->rawColumns(['no','nama','status','action'])
                            ->make(true);
        }
        return view('backend.ijin_absen.index');
    }

    public function b_detail($id)
    {
        $data['ijin_absen'] = $this->ijin_absen->find($id);
        
        if (empty($data['ijin_absen'])) {
            return redirect()->back()->with('error','Ijin Absen Tidak Ditemukan');
        }

        return view('backend.ijin_absen.detail',$data);
    }

    public function b_validasi($id)
    {
        $data['ijin_absen'] = $this->ijin_absen->find($id);

        if (empty($data['ijin_absen'])) {
            return redirect()->back()->with('error','Ijin Absen Tidak Ditemukan');
        }

        return view('backend.ijin_absen.validasi',$data);
    }

    public function b_validasi_simpan(Request $request,$id)
    {
        $data_ijin_absen = $this->ijin_absen::find($id);
        if (empty($data_ijin_absen)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Data Ijin Absen Tidak Ditemukan'
            ]);
        }

        // if ($request->saksi_2) {
        //     dd('OK');
        // }

        if ($request->saksi_1) {
            if (!empty($data_ijin_absen->ijin_absen_ttd->signature_saksi_1)) {
                $explode_signature_saksi_1 = explode('|',$data_ijin_absen->ijin_absen_ttd->signature_saksi_1);
                $input['signature_saksi_1'] = $explode_signature_saksi_1[0].'|'.$explode_signature_saksi_1[1].'|'.$request->saksi_1;
                $input['tgl_signature_saksi_1'] = Carbon::now();
            }
        }

        if ($request->saksi_2) {
            if (!empty($data_ijin_absen->ijin_absen_ttd->signature_saksi_2)) {
                $explode_signature_saksi_2 = explode('|',$data_ijin_absen->ijin_absen_ttd->signature_saksi_2);
                $input['signature_saksi_2'] = $explode_signature_saksi_2[0].'|'.$explode_signature_saksi_2[1].'|'.$request->saksi_2;
                $input['tgl_signature_saksi_2'] = Carbon::now();
            }
        }

        if ($request->signature_manager) {
            if (!empty($data_ijin_absen->ijin_absen_ttd->signature_manager)) {
                $explode_signature_manager = explode('|',$data_ijin_absen->ijin_absen_ttd->signature_manager);
                $input['signature_manager'] = $explode_signature_manager[0].'|'.$explode_signature_manager[1].'|'.$request->signature_manager;
                $input['tgl_signature_manager'] = Carbon::now();
            }else{
                $input['signature_manager'] = auth()->user()->name.'|'.auth()->user()->nik.'|'.$request->signature_manager;
                $input['tgl_signature_manager'] = Carbon::now();
            }
        }

        if ($request->signature_bersangkutan) {
            if (!empty($data_ijin_absen->ijin_absen_ttd->signature_bersangkutan)) {
                $explode_signature_bersangkutan = explode('|',$data_ijin_absen->ijin_absen_ttd->signature_bersangkutan);
                $input['signature_bersangkutan'] = $explode_signature_bersangkutan[0].'|'.$explode_signature_bersangkutan[1].'|'.$request->signature_bersangkutan;
                $input['tgl_signature_bersangkutan'] = Carbon::now();
            }
        }
        // dd($input);
        // dd($request->all());
        $update_ttd = $data_ijin_absen->ijin_absen_ttd->update($input);
        if ($update_ttd) {
            if (!empty($data_ijin_absen->ijin_absen_ttd->signature_manager)) {
                $explode_status_signature_manager = explode('|',$data_ijin_absen->ijin_absen_ttd->signature_manager);
                $status_manager = $explode_status_signature_manager[2];
            }else{
                $status_manager = 'Waiting';
            }

            if (!empty($data_ijin_absen->ijin_absen_ttd->signature_bersangkutan)) {
                $explode_status_signature_bersangkutan = explode('|',$data_ijin_absen->ijin_absen_ttd->signature_bersangkutan);
                $status_bersangkutan = $explode_status_signature_bersangkutan[2];
            }else{
                $status_bersangkutan = 'Waiting';
            }

            if (!empty($data_ijin_absen->ijin_absen_ttd->signature_saksi_1)) {
                $explode_status_signature_saksi_1 = explode('|',$data_ijin_absen->ijin_absen_ttd->signature_saksi_1);
                $status_saksi_1 = $explode_status_signature_saksi_1[2];
            }else{
                $status_saksi_1 = 'Waiting';
            }

            if (!empty($data_ijin_absen->ijin_absen_ttd->signature_saksi_2)) {
                $explode_status_signature_saksi_2 = explode('|',$data_ijin_absen->ijin_absen_ttd->signature_saksi_2);
                $status_saksi_2 = $explode_status_signature_saksi_2[2];
            }else{
                $status_saksi_2 = 'Waiting';
            }

            if ($status_manager == 'Approved' && $status_bersangkutan == 'Approved' && $status_saksi_1 == 'Approved' && $status_saksi_2 == 'Approved') {
                Mail::to($data_ijin_absen->email)
                    ->send(new IjinAbsenNotif(
                        'Konfirmasi Ijin Absen',
                        $data_ijin_absen->no.'-'.$data_ijin_absen->created_at->format('Ymd'),
                        $data_ijin_absen->nama,
                        $data_ijin_absen->jabatan,
                        $data_ijin_absen->unit_kerja,
                        $data_ijin_absen->email,
                        $data_ijin_absen->hari,
                        $data_ijin_absen->tgl_mulai,
                        $data_ijin_absen->tgl_berakhir,
                        $data_ijin_absen->selama,
                        $data_ijin_absen->keperluan,
                        'Disetujui'
                ));
                $data_ijin_absen->update([
                    'status' => 'Approved'
                ]);
            }
            elseif($status_manager == 'Approved' && $status_bersangkutan == 'Approved' && $status_saksi_1 == 'Approved' && $status_saksi_2 == 'Rejected') {
                Mail::to($data_ijin_absen->email)
                    ->send(new IjinAbsenNotif(
                        'Konfirmasi Ijin Absen',
                        $data_ijin_absen->no.'-'.$data_ijin_absen->created_at->format('Ymd'),
                        $data_ijin_absen->nama,
                        $data_ijin_absen->jabatan,
                        $data_ijin_absen->unit_kerja,
                        $data_ijin_absen->email,
                        $data_ijin_absen->hari,
                        $data_ijin_absen->tgl_mulai,
                        $data_ijin_absen->tgl_berakhir,
                        $data_ijin_absen->selama,
                        $data_ijin_absen->keperluan,
                        'Ditolak'
                ));
                $data_ijin_absen->update([
                    'status' => 'Rejected'
                ]);
            }
            elseif($status_manager == 'Approved' && $status_bersangkutan == 'Approved' && $status_saksi_1 == 'Rejected' && $status_saksi_2 == 'Rejected') {
                Mail::to($data_ijin_absen->email)
                    ->send(new IjinAbsenNotif(
                        'Konfirmasi Ijin Absen',
                        $data_ijin_absen->no.'-'.$data_ijin_absen->created_at->format('Ymd'),
                        $data_ijin_absen->nama,
                        $data_ijin_absen->jabatan,
                        $data_ijin_absen->unit_kerja,
                        $data_ijin_absen->email,
                        $data_ijin_absen->hari,
                        $data_ijin_absen->tgl_mulai,
                        $data_ijin_absen->tgl_berakhir,
                        $data_ijin_absen->selama,
                        $data_ijin_absen->keperluan,
                        'Ditolak'
                ));
                $data_ijin_absen->update([
                    'status' => 'Rejected'
                ]);
            }
            elseif($status_manager == 'Approved' && $status_bersangkutan == 'Rejected' && $status_saksi_1 == 'Rejected' && $status_saksi_2 == 'Rejected') {
                Mail::to($data_ijin_absen->email)
                    ->send(new IjinAbsenNotif(
                        'Konfirmasi Ijin Absen',
                        $data_ijin_absen->no.'-'.$data_ijin_absen->created_at->format('Ymd'),
                        $data_ijin_absen->nama,
                        $data_ijin_absen->jabatan,
                        $data_ijin_absen->unit_kerja,
                        $data_ijin_absen->email,
                        $data_ijin_absen->hari,
                        $data_ijin_absen->tgl_mulai,
                        $data_ijin_absen->tgl_berakhir,
                        $data_ijin_absen->selama,
                        $data_ijin_absen->keperluan,
                        'Ditolak'
                ));
                $data_ijin_absen->update([
                    'status' => 'Rejected'
                ]);
            }
            elseif($status_manager == 'Rejected' && $status_bersangkutan == 'Rejected' && $status_saksi_1 == 'Rejected' && $status_saksi_2 == 'Rejected') {
                Mail::to($data_ijin_absen->email)
                    ->send(new IjinAbsenNotif(
                        'Konfirmasi Ijin Absen',
                        $data_ijin_absen->no.'-'.$data_ijin_absen->created_at->format('Ymd'),
                        $data_ijin_absen->nama,
                        $data_ijin_absen->jabatan,
                        $data_ijin_absen->unit_kerja,
                        $data_ijin_absen->email,
                        $data_ijin_absen->hari,
                        $data_ijin_absen->tgl_mulai,
                        $data_ijin_absen->tgl_berakhir,
                        $data_ijin_absen->selama,
                        $data_ijin_absen->keperluan,
                        'Ditolak'
                ));
                $data_ijin_absen->update([
                    'status' => 'Rejected'
                ]);
            }

            $message_title="Berhasil !";
            $message_content="Verifikasi Ijin Absen Berhasil Dibuat";
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
        $data['ijin_absen'] = $this->ijin_absen->find($id);
        if (empty($data['ijin_absen'])) {
            return redirect()->back()->with('error','Ijin Absen Tidak Ditemukan');
        }
        $customPaper = array(0,0,812.5,396);
        $pdf = PDF::loadView('backend.ijin_absen.cetak_surat',$data);
        $pdf->setPaper($customPaper);
        return $pdf->stream('Ijin Absen Tgl '.$data['ijin_absen']->created_at->isoFormat('DD MMMM YYYY').' '.$data['ijin_absen']->nama.' ('.$data['ijin_absen']->nik.')'.'.pdf');
    }

    public function b_download_rekap(Request $request)
    {
        $data['ijin_absens'] = $this->ijin_absen->whereDate('created_at','>=',$request->mulai_tanggal)
                                                ->whereDate('created_at','<=',$request->sampai_tanggal)
                                                ->orderBy('created_at','asc')
                                                // ->whereBetween('created_at',["$request->mulai_tanggal", "$request->sampai_tanggal"])
                                                ->get();
        $customPaper = array(0,0,812.5,396);
        $pdf = PDF::loadView('backend.ijin_absen.download_rekap',$data);
        $pdf->setPaper($customPaper);
        return $pdf->stream('Rekap Ijin Absen Tgl '.Carbon::parse($request->mulai_tanggal)->format('d-m-Y').' sd '.Carbon::parse($request->sampai_tanggal)->format('d-m-Y'));
    }

    public function b_attachment_simpan(Request $request,$id)
    {
        // dd($request->file('attachment'));
        $ijin_absen_attachment = $this->ijin_absen_attachment->where('ijin_absen_id',$id)->first();

        // if ($request->hasFile('attachment')) {
        //     $attachment = $request->file('attachment');
        //     foreach ($attachment as $atc) {
        //         if ($atc->getClientOriginalExtension() == 'jpg' || $atc->getClientOriginalExtension() == 'jpeg' || $atc->getClientOriginalExtension() == 'png') {
        //             $filename = $ijin_absen_attachment->ijin_absen->nik.'-'.$ijin_absen_attachment->ijin_absen->nama.'-'.time().'.'.$atc->getClientOriginalExtension();
        //             // $atc->move(public_path('ijin_absensi/'),$filename);
        //             // $dataAttachment[] = $filename;
        //             // $imgAttachment = \Image::make(public_path('ijin_absensi/'.$filename));
        //             $imgAttachment = \Image::make($atc->move(public_path('ijin_absensi/'),$filename));
        //             // $imgAttachment = \Image::make($atc->path());
        //             $imgAttachment = $imgAttachment->encode('webp',75);
        //             $inputAttachment = $ijin_absen_attachment->ijin_absen->nik.'-'.$ijin_absen_attachment->ijin_absen->nama.'-'.time().'.webp';
        //             $dataAttachment[] = $inputAttachment;
        //             $imgAttachment->save(public_path('ijin_absensi/').$inputAttachment);
        //             // File::delete(public_path('ijin_absensi/'.$filename));
        //         }else{
        //             return redirect()->back()->with('error','Attachment tidak sesuai format.');
        //         }
        //     }
        //     $save_attachment = json_encode($dataAttachment);
        // }else{
        //     $save_attachment = null;
        // }

        if ($request->hasFile('attachment')) {
            $allowedfileExtension=['jpg','png','jpeg','JPG','PNG','JPEG'];
            $files = $request->file('attachment');
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                if ($check) {
                    $imgAttachment = \Image::make($file->move(public_path('ijin_absensi/'),$filename));
                    $imgAttachment->encode('webp',75);
                    $inputAttachment = $ijin_absen_attachment->ijin_absen->nik.'-'.$ijin_absen_attachment->ijin_absen->nama.'-'.rand(100,999).'.webp';
                    $dataAttachment[] = $inputAttachment;
                    $imgAttachment->save(public_path('ijin_absensi/').$inputAttachment);
                    File::delete(public_path('ijin_absensi/'.$filename));
                }
            }
            $save_attachment = json_encode($dataAttachment);
            $ijin_absen_attachment->update([
                'attachment' => $save_attachment
            ]);
        }
        

        if ($ijin_absen_attachment) {
            $message_title="Berhasil !";
            $message_content="Attachment Berhasil Dikirim";
            $message_type="success";
            $message_succes = true;
            
            $array_message = array(
                'success' => $message_succes,
                'message_title' => $message_title,
                'message_content' => $message_content,
                'message_type' => $message_type,
            );
            return response()->json($array_message);
        }

        return response()->json([
            'success' => false,
            'message_title' => 'Gagal',
            'message_content' => 'Attachment Gagal Dikirim, silahkan periksa berkas kembali'
        ]);
    }
}
