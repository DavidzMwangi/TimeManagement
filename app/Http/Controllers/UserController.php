<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function userView()
    {
        return view('backend.user.all_users');
    }

    public function getAllUsers()
    {
        return response()->json(User::all());
    }

    public function saveNewUser(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed',

        ]);
        $user_role=Role::where('name','RegularUser')->first();
        $maager_role=Role::where('name','Manager')->first();
        $admin=Role::where('name','Admin')->first();

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->user_type=$request->user_type;

        switch ($request->user_type){
            case 0:
                $user->assignRole($admin);

                break;

            case 1:
                $user->assignRole($maager_role);

                break;

            case 2:
                $user->assignRole($user_role);

                break;

            default:

                break;
        }


        $user->save();


        return response()->json(User::all());

    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return response()->json(User::all());

    }

    public function manageUsersView()
    {
        return view('backend.user.manager_users');
    }

    public function getAllRegularUsers()
    {
        return response()->json(User::where('user_type','2')->get());
    }

    public function deActivateUser(User $user)
    {
        $user->is_active=false;
        $user->save();

        return response()->json(User::all());
    }

    public function activateUser(User $user)
    {
        $user->is_active=true;
        $user->save();

        return response()->json(User::all());
    }
}
