<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use \Carbon\Carbon;
use DB;
use Validator;
use Hash;

class ProfileController extends Controller
{
    function __construct(User $user){
        $this->user = $user;
    }

    public function index()
    {
        $data['user'] = $this->user->find(auth()->user()->id);
        return view('backend.profile.index',$data);
    }

    public function setting()
    {
        $data['user'] = $this->user->find(auth()->user()->id);
        return view('backend.profile.setting',$data);
    }

    public function update(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ];

        $messages = [
            'email.required' => 'Password wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password_confirmation.required' => 'Konfirmasi Password wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $user = $this->user->where('id_generate',auth()->user()->id_generate)->first();
            if ($request->password == $request->password_confirmation) {
                $user->update([
                    'email' => $request->email,
                    'password' => Hash::make($request->password_confirmation)
                ]);

                if ($user) {
                    return response()->json([
                        'success' => true,
                        'message_title' => 'Berhasil',
                        'message_content' => 'Password Berhasil Diubah'
                    ]);
                }
                return response()->json([
                    'success' => false,
                    'message_title' => 'Gagal',
                    'message_content' => 'Password Tidak Berhasil Diubah'
                ]);
            }
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Password Tidak Sama'
            ]);
        }

        return response()->json(
            [
                'success' => false,
                'error' => $validator->errors()->all()
            ]
        );
    }
}
