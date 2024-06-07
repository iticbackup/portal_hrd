<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Role;
use \Carbon\Carbon;

use DB;
use Hash;
use Cache;
use DataTables;
use Validator;

class UserController extends Controller
{
    function __construct(
        User $user,
        Role $role
    ){
        $this->user = $user;
        $this->role = $role;
        $this->middleware('permission:user-management-list', ['only' => ['index']]);
        $this->middleware('permission:user-management-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:user-management-delete', ['only' => ['edit','update']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->user->all();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                $btn = "<div>";
                                $btn = $btn."<a href=".route('user.edit',['generate' => $row->id_generate])." class='btn btn-warning mb-2 me-2'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 28 28'>
                                                <path fill='currentColor' fill-rule='evenodd' d='M5 20h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m-1-5L14 5l3 3L7 18H4zM15 4l2-2l3 3l-2.001 2.001z' />
                                            </svg> Edit
                                            </a>";
                                $btn = $btn."<form action=".route('roles.destroy',['id' => $row->id])." method='GET'>";
                                $btn = $btn."<button type='submit' class='btn btn-danger mb-2 me-2'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 28 28'>
                                                <path fill='currentColor' d='M4 5h3V4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1h3a1 1 0 0 1 0 2h-1v13a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7H4a1 1 0 1 1 0-2m3 2v13h10V7zm2-2h6V4H9zm0 4h2v9H9zm4 0h2v9h-2z' />
                                            </svg> Delete</button>";
                                $btn = $btn."<form>";
                                $btn = $btn."</div>";

                                return $btn;
                            })
                            ->rawColumns(['action','last_seen'])
                            ->make(true);
        }
        $data['roles'] = $this->role->pluck('name','name')->all();
        return view('backend.users.index',$data);
    }

    public function simpan(Request $request)
    {
        $rules = [
            'username' => 'required',
            'name' => 'required',
            // 'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ];

        $messages = [
            'username.required'  => 'Username wajib diisi.',
            'name.required'  => 'Name wajib diisi.',
            // 'password.required'  => 'Password wajib diisi.',
            // 'password.same'  => 'Password harus sama.',
            'roles.required'  => 'Roles User wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $input = $request->all();
            $input['username'] = $request->username;
            $input['id_generate'] = Str::uuid()->toString();
            $input['password'] = Hash::make('default123');
    
            $user = $this->user->create($input);
            $user->assignRole($request->input('roles'));

            if ($user) {
                $message_title="Berhasil !";
                $message_content="User Berhasil Dibuat";
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

    public function detail($generate)
    {
        $detail_user = $this->user->where('id_generate',$generate)->first();
        if (empty($detail_user)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'User tidak ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $detail_user
        ]);
    }

    public function edit($generate)
    {
        $data['user'] = $this->user->where('id_generate',$generate)->first();
        if (empty($data['user'])) {
            return redirect()->back()->with('error','Data tidak ditemukan');
        }
        $data['roles'] = $this->role->pluck('name','name')->all();
        $data['userRole'] = $data['user']->roles->pluck('name','name')->all();
        return view('backend.users.edit',$data);
    }

    public function update(Request $request, $generate)
    {
        $this->validate($request, [
            'name' => 'required',
            // 'email' => 'required|email|unique:users,email,'.$id,
            // 'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        // if(!empty($input['password'])){ 
        //     $input['password'] = Hash::make($input['password']);
        // }else{
        //     $input = Arr::except($input,array('password'));    
        // }
    
        $user = $this->user->where('id_generate',$generate)->first();
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('user')
                        ->with('success','User updated successfully');
    }
}
