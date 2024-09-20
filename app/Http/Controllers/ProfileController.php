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
            'no_telp' => 'required',
            'email' => 'required',
            // 'password' => 'required',
            // 'password_confirmation' => 'required',
        ];

        $messages = [
            'no_telp.required' => 'No Telp wajib diisi',
            // 'no_telp.unique' => 'No Telp sudah ada',
            'email.required' => 'Email wajib diisi',
            // 'email.unique' => 'Email sudah ada',
            
            // 'password.required' => 'Password wajib diisi',
            // 'password_confirmation.required' => 'Konfirmasi Password wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            // dd($request->all());
            $user = $this->user->where('id_generate',auth()->user()->id_generate)->first();
            // dd($user);
            if ($request->password && $request->password_confirmation) {
                $user->update([
                    'no_telp' => $request->no_telp,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
            }else{
                $user->update([
                    'email' => $request->email,
                    'no_telp' => $request->no_telp,
                ]);
            }

            // $user->update([
            //     'no_telp' => $request->no_telp,
            // ]);

            if ($user) {
                return response()->json([
                    'success' => true,
                    'message_title' => 'Berhasil',
                    'message_content' => 'User '.$user->name.' Berhasil Diupdate'
                ]);
            }

        }

        return response()->json(
            [
                'success' => false,
                'error' => $validator->errors()->all()
            ]
        );
    }
}
