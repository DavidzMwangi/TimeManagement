<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use phpseclib\Crypt\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    //

    private  $client;

    public function __construct()
    {
        $this->client=Client::find(2);
    }
    public function register(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'user_type'=>'required|digits_between:0,3|numeric',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        //register the user
        $user=User::create([

            'name' => request('name'),
            'email' => request('email'),
            'password' =>bcrypt(request('password')),
            'user_type'=>request('user_type'),
            'is_confirmed'=>false,
        ]);
        $user_role=Role::where('name','RegularUser')->first();
        $maager_role=Role::where('name','Manager')->first();
        $admin=Role::where('name','Admin')->first();
        switch (request('user_type')){
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
                $user->assignRole($user_role);

                break;
        }

        $params=[
            'grant_type'=>'password',
            'client_id'=>$this->client->id,
            'client_secret'=>$this->client->secret,
            'username'=>request('email'),
            'password'=>request('password'),
            'scope'=>'*'
        ];


        $request->request->add($params);

        $proxy=Request::create('oauth/token','POST');

        return Route::dispatch($proxy);
    }
}
