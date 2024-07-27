<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Carbon\Carbon;
use DB;
use Validator;
use DataTables;

class RoleController extends Controller
{
    function __construct(
        Role $role,
        Permission $permission
    )
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->role->all();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                $btn = "<div>";
                                $btn = $btn."<a href=".route('roles.edit',['id' => $row->id])." type='button' class='btn btn-warning mb-2 me-2'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 28 28'>
                                                <path fill='currentColor' fill-rule='evenodd' d='M5 20h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m-1-5L14 5l3 3L7 18H4zM15 4l2-2l3 3l-2.001 2.001z' />
                                            </svg> Edit
                                            </a>";
                                $btn = $btn."<form action=".route('roles.destroy',['id' => $row->id])." method='DELETE'>";
                                $btn = $btn."<button type='submit' class='btn btn-danger mb-2 me-2'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 28 28'>
                                                <path fill='currentColor' d='M4 5h3V4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1h3a1 1 0 0 1 0 2h-1v13a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7H4a1 1 0 1 1 0-2m3 2v13h10V7zm2-2h6V4H9zm0 4h2v9H9zm4 0h2v9h-2z' />
                                            </svg> Delete</button>";
                                $btn = $btn."<form>";
                                $btn = $btn."</div>";

                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
        // $data['permissions'] = $this->permission->all();
        \DB::statement("SET SQL_MODE=''");
        $permissions = $this->permission->select('id','name')->groupBy('name')->orderBy('created_at','asc')->get();
        $data['custom_permission'] = array();

        foreach ($permissions as $per) {
            $key = substr($per->name, 0, strpos($per->name, "-"));
            if(str_starts_with($per->name, $key)){
                $data['custom_permission'][$key][] = $per;
            }
        }

        // dd($data);
        return view('backend.roles.index',$data);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ];

        $messages = [
            'name' => 'Name Guard is required',
            'permission' => 'Permission is required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->passes()) {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));

            if ($role) {
                $message_title="Berhasil !";
                $message_content="Roles Success";
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
        // $this->validate($request, [
        //     'name' => 'required|unique:roles,name',
        //     'permission' => 'required',
        // ]);
    
        // $role = Role::create(['name' => $request->input('name')]);
        // $role->syncPermissions($request->input('permission'));

        // return response()->json([
        //     'success' => true,
        //     'message_content' => 'Role created successfully'
        // ]);
    }

    public function show($id)
    {
        $role = $this->role->find($id);
        if (empty($role)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Data Tidak Ditemukan'
            ]);
        }
        $rolePermissions = $this->permission->join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
                        ->where("role_has_permissions.role_id",$id)
                        ->get();
        return response()->json([
            'success' => true,
            'data' => [
                'role' => $role,
                'permission' => $rolePermissions
            ]
        ]);
    }

    public function edit($id)
    {
        // $data['role'] = $this->role->find($id);
        // if (empty($data['role'])) {
        //     return redirect()->back()->with(['error' => 'Data tidak ditemukan']);
        // }
        // $data['permissions'] = $this->permission->all();
        // $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        //                         ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        //                         ->all();
        $data['role'] = $this->role->with('permissions')->find($id);
        \DB::statement("SET SQL_MODE=''");
        $permissions = $this->permission->select('name','id')->groupBy('name')->orderBy('created_at','asc')->get();
        $data['custom_permission'] = array();
        foreach($permissions as $per){
            $key = substr($per->name, 0, strpos($per->name, "-"));
            if(str_starts_with($per->name, $key)){
                $data['custom_permission'][$key][] = $per;
            }
        }
        return view('backend.roles.edit',$data);
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'permission' => 'required',
        // ]);
    
        // $role = Role::find($id);
        // // dd($role);
        // $role->name = $request->input('name');
        // $role->save();
    
        // $role->syncPermissions($request->input('permission'));
    
        // return redirect()->route('roles.index')
        //                 ->with('success','Role updated successfully');

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = $this->role->find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}
