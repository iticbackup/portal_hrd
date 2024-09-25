<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MaintenanceWeb;
use \Carbon\Carbon;

use Validator;
use DataTables;

class MaintenanceWebController extends Controller
{

    function __construct(
        MaintenanceWeb $maintenance_web
    )
    {
        $this->maintenance_web = $maintenance_web;
    }

    public function index(Request $request)
    {
        if (auth()->user()->no_telp == null || auth()->user()->email == null) {
            return redirect()->route('profile.setting');
        }

        if ($request->ajax()) {
            $data = $this->maintenance_web->all();

            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('mode', function($row){
                                switch ($row->mode) {
                                    case 'up':
                                        return '<span class="badge bg-success">'.strtoupper($row->mode).'</span>';
                                        break;

                                    case 'down':
                                        return '<span class="badge bg-danger">'.strtoupper($row->mode).'</span>';
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }
                            })
                            ->addColumn('status', function($row){
                                if ($row->status == 'Aktif') {
                                    return '<span class="badge bg-success">'.strtoupper($row->status).'</span>';
                                }else{
                                    return '<span class="badge bg-danger">'.strtoupper($row->status).'</span>';
                                }
                            })
                            ->addColumn('action', function($row){
                                $btn = "<div>";
                                $btn = $btn."<a class='btn btn-dark mb-2 me-2' onclick='execute(".$row->id.")'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'>
                                                    <path fill='currentColor' d='M10 6.2C10 4.3 8.8 2.6 7 2v3.7H4V2c-1.8.6-3 2.3-3 4.2s1.2 3.6 3 4.2v11c0 .4.2.6.5.6h2c.3 0 .5-.2.5-.5v-11c1.8-.6 3-2.3 3-4.3M16 8s-.1 0 0 0c-3.9.1-7 3.2-7 7c0 3.9 3.1 7 7 7s7-3.1 7-7s-3.1-7-7-7m0 12c-2.8 0-5-2.2-5-5s2.2-5 5-5s5 2.2 5 5s-2.2 5-5 5m-1-9v5l3.6 2.2l.8-1.2l-2.9-1.7V11z' />
                                                </svg> Execute</a>";
                                $btn = $btn."<a class='btn btn-warning mb-2 me-2' onclick='edit(".$row->id.")'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 512 512'>
                                                    <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='44' d='M358.62 129.28L86.49 402.08L70 442l39.92-16.49l272.8-272.13zm54.45-54.44l-11.79 11.78l24.1 24.1l11.79-11.79a16.51 16.51 0 0 0 0-23.34l-.75-.75a16.51 16.51 0 0 0-23.35 0' />
                                                </svg> Edit</a>";
                                $btn = $btn."</div>";
    
                                return $btn;
                            })
                            ->rawColumns(['mode','status','action'])
                            ->make(true);
        }

        return view('backend.IT.maintenance_web.index');

    }

    public function simpan(Request $request)
    {
        $rules = [
            'name' => 'required',
            'mode' => 'required',
            'status' => 'required',
        ];
    
        $messages = [
            'name.required' => 'Nama Maintenance Wajib Diisi',
            'mode.required' => 'Mode Maintenance Wajib Diisi',
            'status.required' => 'Status Maintenance Wajib Diisi',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $no_urut = $this->maintenance_web->count();
            
            if ($no_urut == 0) {
                $input['id'] = 1;
            }else{
                $input['id'] = $no_urut+1;
            }

            $input['name'] = $request->name;
            $input['secret'] = rand(1000,9999);
            $input['mode'] = $request->mode;
            $input['status'] = $request->status;

            $maintenance_web = $this->maintenance_web->create($input);
            
            if ($maintenance_web) {
                $message_title="Berhasil !";
                $message_content="Data ".$input['name']." Berhasil Dibuat.";
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
        $data = $this->maintenance_web->find($id);

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal!',
                'message_content' => 'Data Tidak Ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function eksekusi($id)
    {
        $data = $this->maintenance_web->where('id',$id)->where('status','Aktif')->first();

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal!',
                'message_content' => 'Data Tidak Ditemukan'
            ]);
        }

        \Artisan::call($data->mode,[
            '--secret' => $data->secret
        ]);

        return response()->json([
            'success' => true,
            'message_title' => 'Berhasil!',
            'message_content' => 'Maintenance '.$data->name.' Berhasil Nyala'
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'edit_name' => 'required',
            'edit_mode' => 'required',
            'edit_status' => 'required',
        ];
    
        $messages = [
            'edit_name.required' => 'Nama Maintenance Wajib Diisi',
            'edit_mode.required' => 'Mode Maintenance Wajib Diisi',
            'edit_status.required' => 'Status Maintenance Wajib Diisi',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $maintenance_web = $this->maintenance_web->find($request->edit_id);
            
            $input['name'] = $request->edit_name;
            $input['mode'] = $request->edit_mode;
            $input['status'] = $request->edit_status;

            $maintenance_web->update($input);
            
            if ($maintenance_web) {
                $message_title="Berhasil !";
                $message_content="Data ".$input['name']." Berhasil Diupdate.";
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
}
