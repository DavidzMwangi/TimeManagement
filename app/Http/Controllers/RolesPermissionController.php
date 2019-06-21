<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionController extends Controller
{
    public function __invoke()
    {
        return view('backend.roles_permissions.roles_permissions')->withRoles(Role::all())->withPermissions(Permission::all());
    }


    public function getOtherPermissions(Request $request)
    {
        $role_id=$request->input('role_id');

        $existing_permissions = Role::findById($role_id)->permissions->pluck('id');
        if (!empty($existing_permissions)){
            $other_permissions=Permission::whereNotIn('id',$existing_permissions)->get();
        }else{
            $other_permissions=Permission::all();
        }
        return response()->json(['records'=>
            $other_permissions]);


    }

    public function updatePermissionRole(Request $request)
    {
        $permissions=$request->input('permissions');
        $role_id=$request->input('role_id');
        foreach ($permissions as $permission){
            $permission_rec=Permission::findById($permission);
            Role::findById($role_id)->givePermissionTo($permission_rec->name);
        }

        return response()->json([
            'sucess'=>true
        ]);
    }

    public function getActivePermissions(Request $request)
    {
        $role_permisions=Role::findById($request->input('role_id'))->permissions->pluck('id');

        if (!empty($role_permisions)){
            $current_permissions=Permission::whereIn('id',$role_permisions)->get();
        }else{
            $current_permissions=null;
        }


        return response()->json([
            'current_permissions'=>$current_permissions
        ]);
    }

    public function revokePermissionToRole(Request $request)
    {
        $permissions=$request->input('permissions');
        $role=Role::findById($request->input('role_id'));

        foreach ($permissions as $permission){
            $role->revokePermissionTo($permission);
        }

        return response()->json([
            'success'=>true
        ]);
    }
}
