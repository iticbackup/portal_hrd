<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Validator;

class DatabaseKaryawanController extends Controller
{

    function __construct(
        User $user
    ){
        $this->user = $user;
    }

    public function search_nik($nik)
    {
        $data = $this->user->where('nik',$nik)->first();
        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal!',
                'error' => 'NIK Karyawan Tidak Ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'nik' => $data->nik,
                'name' => $data->name,
                'email' => $data->email,
                'departemen' => $data->biodata_karyawan->departemen->nama_departemen,
                'bagian' => explode(' ',$data->biodata_karyawan->posisi->nama_posisi)[0],
            ]
        ]);
    }

    public function create()
    {
        return view('frontend.data_karyawan.create');
    }

    public function update(Request $request)
    {
        $rules = [
            'email' => 'required',
        ];

        $messages = [
            'email.required'  => 'Email Wajib Diisi.',
            // 'email.unique'  => 'Email Tidak Boleh Sama.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->passes()) {
            $user = $this->user->where('nik',$request->nik)->update([
                'email' => $request->email
            ]);

            if ($user) {
                $message_title="Berhasil !";
                $message_content="Data Karyawan Berhasil Diupdate.";
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
