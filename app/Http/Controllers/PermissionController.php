<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use \Carbon\Carbon;
use DB;
use Validator;
use DataTables;

class PermissionController extends Controller
{
    function __construct(
        Permission $permission
    )
    {
        $this->permission = $permission;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->permission->all();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                $btn = "<div>";
                                $btn = $btn."<button type='button' class='btn btn-warning mb-2 me-2' onclick='edit(`".$row->id."`)'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 28 28'>
                                                <path fill='currentColor' fill-rule='evenodd' d='M5 20h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m-1-5L14 5l3 3L7 18H4zM15 4l2-2l3 3l-2.001 2.001z' />
                                            </svg> Edit</button>";
                                $btn = $btn."<button type='button' class='btn btn-danger mb-2 me-2'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 28 28'>
                                                <path fill='currentColor' d='M4 5h3V4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1h3a1 1 0 0 1 0 2h-1v13a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7H4a1 1 0 1 1 0-2m3 2v13h10V7zm2-2h6V4H9zm0 4h2v9H9zm4 0h2v9h-2z' />
                                            </svg> Delete</button>";
                                $btn = $btn."</div>";

                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
        return view('backend.permission.index');
    }

    public function simpan(Request $request)
    {
        $rules = [
            'name' => 'required',
            'guard_name' => 'required',
        ];

        $messages = [
            'name.required'  => 'Nama Permission wajib diisi.',
            'guard_name.required'  => 'Nama Akses wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $input = $request->all();
            $permission = $this->permission->create($input);
            $permission->syncPermissions($request->input('permission'));

            if($permission){
                $message_title="Berhasil !";
                $message_content="Data Berhasil Dibuat";
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
        $permission = $this->permission->find($id);
        if (empty($permission)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Data tidak ditemukan'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $permission
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'edit_name' => 'required',
            'edit_guard_name' => 'required',
        ];

        $messages = [
            'edit_name.required'  => 'Nama Permission wajib diisi.',
            'edit_guard_name.required'  => 'Nama Akses wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $permission = $this->permission->find($request->edit_id);
            $permission->name = $request->edit_name;
            $permission->guard_name = $request->edit_guard_name;
            $permission->update();
            $permission->syncPermissions($request->input('permission'));
            if($permission){
                $message_title="Berhasil !";
                $message_content="Data Berhasil Diupdate";
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
